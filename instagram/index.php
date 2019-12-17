<!-- INSTAGRAM PAGE -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Instagram Posts</title>
    <div>
        <?php
          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/scripts/php/header.php";
          include_once($path);
        ?>
        <h1 style="text-align:center;font-size:5vw;font-weight:bold;color:#4d000d;font-family:impact,fantasy;">Recent Instagram Posts</h1>
    </div>
    <style>
        body{
            background: linear-gradient(to bottom, #ffe6ea 0%, #ff8095 100%);
        }
        .item_box{
            margin: auto;
            width: 30%;
        }
        .photo-thumb{
            display: block;
          	width: 100%;
          	height: auto;
            border-radius: 5%;
        }
        .photo-thumb:hover{
            transform: scale(1.05);
        }
        .container{
            display: flex;
            flex-wrap: wrap;
        }
        .likes{
            font-family: helvetica;
            text-align: right;
            font-size: 2vw;
            color: #ff8095;
            margin-right: 2vw;
        }
        .caption{
            font-family: helvetica;
            text-align: left;
            font-size: 1.5vw;
            margin-left: 1vw;
            margin-right: 1vw;
        }
        .date{
            font-family: helvetica;
            color: #ffffff;
            font-size: 1vw;
            margin-left: 2vw;
        }
        @media screen and (max-width:800px){
            .item_box{
                width: 100%;
            }
            .likes{
                font-size: 10vw;
            }
            .caption{
                font-size: 8vw;
            }
            .date{
                font-size: 6vw;
            }
        }
    </style>

</head>
<body>
<div class="container">

<!-- Instagram feed will be here -->
<?php
$access_token="250606221.1b8770e.0de83f44088f470a88ff399ded39b278";
$photo_count=18;

$json_link="https://api.instagram.com/v1/users/self/media/recent/?";
$json_link.="access_token={$access_token}&count={$photo_count}";
$json = file_get_contents($json_link);
$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
foreach ($obj['data'] as $post) {

    $pic_text=$post['caption']['text'];
    $pic_link=$post['link'];
    $pic_like_count=$post['likes']['count'];
    $pic_comment_count=$post['comments']['count'];
    $pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);
    $pic_created_time=date("F j, Y", $post['caption']['created_time']);
    $pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));

    echo "<div class='item_box'>";
        echo "<a href='{$pic_link}' target='_blank'>";
            echo "<img class='img-responsive photo-thumb' src='{$pic_src}' alt='{$pic_text}'>";
        echo "</a>";
        echo "<p class='text'>";
            echo "<div class='likes'><i class='fas'>&#xf004</i>{$pic_like_count}</div>";
            echo "<div class='caption'>{$pic_text}</div>";
            echo "<div class='date'>{$pic_created_time}</div>";
        echo "</p>";
    echo "</div>";
  }
  ?>
  </div>
  <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/scripts/php/footer.php";
    include_once($path);
  ?>
</body>
</html>
