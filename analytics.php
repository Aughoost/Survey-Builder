<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
            $i = 1;
                $forms = $db->conn->query("SELECT * FROM `form_list` order by date(date_created) desc");
                while($row = $forms->fetch_assoc()):
            ?>

    <div class="card-list">
        <a href="./index.php?p=graph&code=<?php echo $row['form_code'] ?>" class="card-item">
            <h3>Survey Title: <?php echo $row['title'] ?></h3>
            <div class="arrow">
                <i class="fas fa-arrow-right card-icon"></i>
            </div>
        </a>
    </div>

    <?php endwhile;  ?>
</body>
</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
}
body {
    background: #ecececdb;
}
.card-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    max-width: 1250px;
    margin: 150px auto;
    padding: 20px;
    gap: 20px;
}
.card-list .card-item {
    background: #fff;
    padding: 26px;
    border-radius: 8px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.04);
    list-style: none;
    cursor: pointer;
    text-decoration: none;
    border: 2px solid transparent;
    transition: border 0.5s ease;
}
.card-list .card-item:hover {
    border: 2px solid #000;
}
.card-list .card-item img {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 8px;
    object-fit: cover;
}
.card-list span {
    display: inline-block;
    background: #F7DFF5;
    margin-top: 32px;
    padding: 8px 15px;
    font-size: 0.75rem;
    border-radius: 50px;
    font-weight: 600;
}
.card-list .developer {
    background-color: #F7DFF5; 
    color: #B22485;
}   
.card-list .designer {
    background-color: #d1e8ff;
    color: #2968a8;
}
.card-list .editor {
    background-color: #d6f8d6; 
    color: #205c20;
}
.card-item h3 {
    color: #000;
    font-size: 1.438rem;
    margin-top: 28px;
    font-weight: 600;
}
.card-item .arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    transform: rotate(-35deg);
    height: 40px;
    width: 40px;
    color: #000;
    border: 1px solid #000;
    border-radius: 50%;
    margin-top: 40px;
    transition: 0.2s ease;
}
.card-list .card-item:hover .arrow  {
    background: #000;
    color: #fff; 
}
@media (max-width: 1200px) {
    .card-list .card-item {
        padding: 15px;
    }
}
@media screen and (max-width: 980px) {
    .card-list {
        margin: 0 auto;
    }
}
.home-section .text {
    display: inline !important;
}
</style>
