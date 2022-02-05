<?php
include "assets/header.html";
$conn = mysqli_connect("localhost", "root", "root", "web-php");
$posts_list = mysqli_query($conn, "SELECT * FROM posts ");


$post_id = empty($_GET['post'])?1:$_GET['post'];
$post_info = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM posts WHERE `idPost`='$post_id'"));

?>

<div class="container changeContent">
    <nav class="post-list">
        <?php
        while ($post = mysqli_fetch_array($posts_list)) {
            echo "<li class='card-item'>", "<a class='card-title' href='?post=" . $post["idPost"] . "'>" . $post["title"] . "</a>",
            "</li>";
        }
        ?>
    </nav>
    <div class="post-info">
        <h2>Редактирование поста</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="input-group">
               <img src="<?php echo $post_info['image'];?>" alt="" width="100">
            </div>
            <div class="input-group">
                <label for="title_post">Введите заголовок поста</label>
                <input type="text" name="title_post" id="title_post" value="<?php echo $post_info['title'] ?>">
            </div>
            <div class="input-group">
                <label for="text_post">Введите текст поста</label>
                <textarea name="text_post" id="text_post" cols="30" rows="10"><?php echo $post_info['text'] ?></textarea>
            </div>
            <div class="input-group">
                <label for="img_post">Выберите изображениек поста</label>
                <input type="file" id="img_post" name="img_post">
            </div>
            <div class="input-group">
                <button class="btn" type="submit">Сохранить</button>
            </div>
        <div class="input-group">
                <button name="del" value="delete" class="btn" type="submit">Удалить</button>
            </div>
        </form>

    </div>
</div>

<?php
 
 $title= empty($_POST['title_post'])?false:$_POST['title_post'];
 $text= empty($_POST['text_post'])?false:$_POST['text_post'];
 $tmp=empty($_FILES['img_post']['tmp_name'])?false:$_FILES['img_post']['tmp_name'];
 echo $tmp;
 if($title and $text){
    if($title!=$post_info['title']){
        mysqli_query($conn, "UPDATE posts SET `title`='$title' WHERE `idPost`=".$post_info['idPost']);
    }
    if($text!=$post_info['text']){
        mysqli_query($conn, "UPDATE posts SET `text`='$text' WHERE `idPost`=".$post_info['idPost']);
    }
 }
 if ($tmp){
    $image=$_FILES['img_post']['name'];
    $image=str_replace(' ','|',$image);
    $image="image/".$image;
    $result = mysqli_query($conn, "UPDATE posts SET `image`='$image' WHERE `idPost`=".$post_info
['idPost']);
    echo"UPDATE posts SET`image`='$image' WHERE `idPost`=".$post_info['idPost'];
    if($result){
        move_uploaded_file($_FILES['img_post']['tmp_name'],$image);
    }
    else{

    }
 }
 $delit = $_POST['del'];
 if ($delit == "delete"){
     mysqli_query($conn, "DELETE FROM posts WHERE `idPost`=".$post_info['idPost']);
 }