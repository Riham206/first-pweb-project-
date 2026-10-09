<?php
require "mysql.php";
//recupere l'utilisateur a partir de L'URL
$user = "";
if (isset($_GET["user"])) {
    $user = $_GET["user"];
}
//inisialisation des variables a rien 
$display_name   = "";
$display_addr   = "";
$display_phone  = "";
$display_credit = "";
if ($user != "") {
  $res = $conn->query("SELECT * FROM user WHERE name = '$user'");
   if ($res->num_rows > 0) {
     $u = $res->fetch_assoc();
     $display_name   = $u["name"];
     $display_addr   = $u["adress"];
     $display_phone  = $u["phone"];
     $display_credit = $u["credit"];
    }
}
//tab associatif
$products = [];
$res = $conn->query("SELECT * FROM products");
while ($row = $res->fetch_assoc()) {
    $products[$row["id_p"]] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>your fragrance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/logo.png.png">
<style>
    .t1 { font-size: 200%; border-spacing:10px; }
    .t2 { border-spacing:35px; }
    .ms { text-align: center; }

    .user-form input[type="number"] {
        width: 100%; padding: 8px 10px; border-radius: 5px;
        border: 1px solid #ccc; background: #fff;
        color: #333; font-size: 14px; box-sizing: border-box;
    }
    div.stock {
        color: #d4edda; font-weight: bold;
        margin: 6px 0 5px 0; display: block; font-size: 13px;
    }
    div.stock.out { color: red; }
    .t2 td {
        background-color: rgba(255,255,255,0.05);
        padding: 15px; border-radius: 10px;
        vertical-align: top; text-align: center;
    }
    .card-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        margin-top: 8px;
    }
    .card-form label {
        font-weight: bold;
        color: #f5f5dc;
        font-size: 13px;
    }
    .quantity-input, .stock-input {
        width: 60px; padding: 4px; border-radius: 4px;
        border: 1px solid #ccc; text-align: center;
        background: #fff; color: #333;
    }
    .stock-input { cursor: not-allowed; }
</style>
</head>
<body>
<header class="main-header">
 <img src="images/logo.png.png">
  <div class="search-box">
    <input type="text" placeholder="Search perfumes...">
    <button>search</button>
  </div>
  <div class="user-menu">
   <img src="images/ACOUNT.jpg" class="avatar">
     <div class="dropdown">
       <?php if ($display_name != ""): ?>
         <p>Name: <?php echo $display_name; ?></p>
         <p>Address: <?php echo $display_addr; ?></p>
         <p>Phone: <?php echo $display_phone; ?></p>
         <p>Credit: $<?php echo $display_credit; ?></p>
         <?php else: ?>
          <p>Not logged in</p>
         <?php endif; ?>
     </div>
    </div>
    <h1><i>Your Fragrance</i></h1>
    <nav>
        <section class="s1">
            <table class="t1">
                <tr>
                    <td><a href="#women">Women</a> |</td>
                    <td><a href="#men">Men</a> |</td>
                    <td><a href="#ft">Create Account </a> |</td>
                    <td><a href="https://www.instagram.com/p/DPd3Q9yCCDl/?hl=en"><img src="images/insta.jpg" class="insta"></a></td>
                    <td><a href="https://www.facebook.com/"><img src="images/fb.jpg" class="facebook"></a></td>
                    <td><a href="https://wa.me/myperfume"><img src="images/whats app.jpg" class="whats-app"></a></td>
                </tr>
            </table>
        </section>
    </nav>
</header>

<img src="images/a big image.jpg">
<hr>
<main>

<!-- MEN -->
<section>
 <h2 id="men">Men Perfumes</h2>
  <table class="t2"><tr>
    <?php
    // search about the id if it exist in product and then search about it's stock 
        if (isset($products["1234"])) {
         $stock = $products["1234"]["stock"];
        } else {
         $stock = 0;
        }
        ?>
        <td>
            <img src="images/m1.png" width="200">
            <h6>Tobacco Maniac Theodoros Kalotinis</h6>
            <p>tabaco and sweet scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="1234">
                <input type="hidden" name="price" value="30">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $30</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

    <?php
     if (isset($products["9427"])) {
         $stock = $products["9427"]["stock"];
        } else {
        $stock = 0;
        }
    ?>
     <td>
        <img src="images/m2.png" width="200">
            <h6>The One Gold For Men Dolce&amp;Gold</h6>
            <p>floral and fresh scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="9427">
                <input type="hidden" name="price" value="50">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $50</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

    <?php
        if (isset($products["8734"])) {
         $stock = $products["8734"]["stock"];
        } else {
        $stock = 0;
        }
        ?>
        <td>
            <img src="images/m3.png" width="200">
            <h6>Crimson Rayhaan</h6>
            <p>warm spicy and cinnamon</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="8734">
                <input type="hidden" name="price" value="85">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $85</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

    <?php
        if (isset($products["0932"])) {
         $stock = $products["0932"]["stock"];
        } else {
      $stock = 0;
        }
    ?>
        <td>
            <img src="images/m4.png" width="200">
            <h6>Curve for Men Liz Claiborne</h6>
            <p>woody and citrus scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="0932">
                <input type="hidden" name="price" value="40">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $40</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

    <?php
     if (isset($products["6538"])) {
       $stock = $products["6538"]["stock"];
        } else {
           $stock = 0;
        }
    ?>
        <td>
            <img src="images/m5.png" width="200">
            <h6>Vacation Arquiste</h6>
            <p>sweet and coconut scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="6538">
                <input type="hidden" name="price" value="90">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $90</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

    </tr></table>

    <details>
        <summary class="ms"><b><i>click here for more mens perfumes</i></b></summary>
        <table class="t2"><tr>

            <?php
            if (isset($products["7631"])) {
                $stock = $products["7631"]["stock"];
            } else {
                $stock = 0;
            }
            ?>
            <td>
                <img src="images/m6.png" width="200">
                <h6>Men Only O Boticario</h6>
                <p>fresh spicy and amber scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="7631">
                    <input type="hidden" name="price" value="30">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $30</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

            <?php
            if (isset($products["7638"])) {
                $stock = $products["7638"]["stock"];
            } else {
                $stock = 0;
            }
            ?>
            <td>
                <img src="images/m7.png" width="200">
                <h6>Lavande 31 Le Labo</h6>
                <p>lavender and citrus scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="7638">
                    <input type="hidden" name="price" value="50">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $50</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

     <?php
        if (isset($products["7609"])) {
         $stock = $products["7609"]["stock"];
            } else {
             $stock = 0;
            }
            ?>
            <td>
                <img src="images/m8.png" width="200">
                <h6>Angels Dust Francesca Bianchi</h6>
                <p>powdery and amber scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="7609">
                    <input type="hidden" name="price" value="35">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $35</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

            <?php
            if (isset($products["6487"])) {
                $stock = $products["6487"]["stock"];
            } else {
                $stock = 0;
            }
            ?>
            <td>
                <img src="images/m9.png" width="200">
                <h6>Angham Lattafa Perfumes</h6>
                <p>sweet and lavender scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="6487">
                    <input type="hidden" name="price" value="80">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $80</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

        </tr></table>
    </details>
</section>
<hr>

<!-- WOMEN -->
<section>
    <h2 id="women">Women Perfumes</h2>
    <table class="t2"><tr>

        <?php
        if (isset($products["5238"])) {
            $stock = $products["5238"]["stock"];
        } else {
            $stock = 0;
        }
        ?>
        <td>
            <img src="images/1.png" width="200">
            <h6>Ambery Vanilla Dossier</h6>
            <p>white floral and soft spicy scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="5238">
                <input type="hidden" name="price" value="30">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $30</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

        <?php
        if (isset($products["7864"])) {
            $stock = $products["7864"]["stock"];
        } else {
            $stock = 0;
        }
        ?>
        <td>
            <img src="images/2.png" width="200">
            <h6>DKNY Nectar Love Donna Karan</h6>
            <p>beeswax and honey scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="7864">
                <input type="hidden" name="price" value="50">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $50</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

        <?php
        if (isset($products["8731"])) {
            $stock = $products["8731"]["stock"];
        } else {
            $stock = 0;
        }
        ?>
        <td>
            <img src="images/3.png" width="200">
            <h6>Lophiel Lophiel</h6>
            <p>floral and citrus scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="8731">
                <input type="hidden" name="price" value="55">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $55</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

        <?php
        if (isset($products["6576"])) {
            $stock = $products["6576"]["stock"];
        } else {
            $stock = 0;
        }
        ?>
        <td>
            <img src="images/4.png" width="200">
            <h6>Beige 96 Mine. Perfumery</h6>
            <p>aromatic and woody scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="6576">
                <input type="hidden" name="price" value="75">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $75</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

        <?php
        if (isset($products["3856"])) {
            $stock = $products["3856"]["stock"];
        } else {
            $stock = 0;
        }
        ?>
        <td>
            <img src="images/6.png" width="200">
            <h6>Poltergeist Heretic Parfum</h6>
            <p>aromatic and woody scent</p>
            <form action="buy.php" method="post" class="card-form">
                <input type="hidden" name="id_p" value="3856">
                <input type="hidden" name="price" value="80">
                <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $80</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
            </form>
        </td>

    </tr></table>

    <details>
        <summary class="ms"><b><i>click here for more womens perfumes</i></b></summary>
        <table class="t2"><tr>

            <?php
            if (isset($products["6539"])) {
                $stock = $products["6539"]["stock"];
            } else {
                $stock = 0;
            }
            ?>
            <td>
                <img src="images/5.png" width="200">
                <h6>Perfume 1</h6>
                <p>floral scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="6539">
                    <input type="hidden" name="price" value="80">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $80</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

            <?php
            if (isset($products["6839"])) {
                $stock = $products["6839"]["stock"];
            } else {
                $stock = 0;
            }
            ?>
            <td>
                <img src="images/7.png" width="200">
                <h6>Bare Vanilla Victorias Secret</h6>
                <p>vanilla and powdery scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="6839">
                    <input type="hidden" name="price" value="78">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $78</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

            <?php
            if (isset($products["8799"])) {
                $stock = $products["8799"]["stock"];
            } else {
                $stock = 0;
            }
        ?>
            <td>
                <img src="images/8.png" width="200">
                <h6>Ari Ariana Grande</h6>
                <p>sweet and fruity scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="8799">
                    <input type="hidden" name="price" value="50">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                    <label>Quantity :</label>
                    <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                    <label>Stock :</label>
                    <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                    <div class="price">Price: $50</div>
                    <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

            <?php
            if (isset($products["6785"])) {
                $stock = $products["6785"]["stock"];
            } else {
                $stock = 0;
            }
        ?>
            <td>
                <img src="images/9.png" width="200">
                <h6>Toy 2 Moschino</h6>
                <p>fruity and floral scent</p>
                <form action="buy.php" method="post" class="card-form">
                    <input type="hidden" name="id_p" value="6785">
                    <input type="hidden" name="price" value="55">
                    <input type="hidden" name="name" value="<?php echo $display_name; ?>">
                <label>Quantity :</label>
                <input type="number" name="quantity" min="1" max="<?php echo $stock; ?>" value="1" class="quantity-input" <?php if($stock<=0) echo "disabled"; ?>>
                <label>Stock :</label>
                 <input type="number" value="<?php echo $stock; ?>" class="stock-input" readonly>
                <div class="price">Price: $55</div>
                <button type="submit" class="buy-butn" <?php if($stock<=0) echo "disabled"; ?>><?php if($stock<=0) { echo "Out of Stock"; } else { echo "Buy Now"; } ?></button>
                </form>
            </td>

        </tr></table>
    </details>
</section>

<!-- REGISTER -->
<section id="register">
    <h2>Create Account</h2>
    <form action="register.php" method="post" class="user-form">
        <label>Name:</label>
        <input type="text" name="name" placeholder="enter your name" required><br><br>
        <label>Address:</label>
        <input type="text" name="adress" placeholder="enter your address" required><br><br>
        <label>Phone Number:</label>
        <input type="text" name="phone" placeholder="enter your number" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" placeholder="enter your password" required><br><br>
        <label>Credit:</label>
        <input type="number" name="credit" placeholder="enter your credit" min="0" required><br><br>
        <input type="submit" value="Register" class="buy-butn">
    </form>
</section>
</main>
<footer id="ft">
    <p>© 2026 YOUR Fragrance Boutique</p>
</footer>
</body>
</html>