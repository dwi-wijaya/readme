<?php

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\base\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */
$tag = explode(', ', $model->tag);
$this->registerCssFile('@web/css/pages/detail.css');
$this->title = $model->title;
// $this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$c_bookmark = $bookmark == 'true' ? 'fa-solid' : 'fa-regular';
$c_like = $like == 'true' ? 'fa-solid' : 'fa-regular';
// echo '<pre>';print_r($urlfrom);die;
$guest_link = Yii::$app->user->isGuest ? Url::to(['site/login']) : '#'; 
?>
<style>

</style>
<article class="article-view">
    <div class="row">
        <div class="col-lg-9">
            <div class="article-content card card-body  b-10">
                <div class="utils">
                    <div class="d-flex">
                        <a data="<?= $model->idarticle; ?>" id="bookmark" href="<?= $guest_link ?>"><i class="utils-action <?= $c_bookmark; ?> fa-bookmark"></i></a>
                        <a data="<?= $model->idarticle; ?>" id="heart" href="<?= $guest_link ?>"><i class="utils-action <?= $c_like; ?> fa-heart"></i></a>
                    </div>
                </div>
                <div>
                    <img width="20" height="20" src="<?= Utils::baseUploadsProfile($model->user->profile_picture); ?>" alt="" srcset="">
                    <small class="text-muted"> <?= $model->user->first_name . ' ' . $model->user->last_name . ' - ' . Yii::$app->formatter->asDate($model->created_at); ?></small>
                    <h1><?= $model->title; ?></h1>
                    <hr class="hr">
                    <div class="tag mt-3">
                        <?php foreach ($tag as $tag) : ?>
                            <a href="<?= Url::to(['/site/index?Article%5Bsearch%5D=' . $tag]); ?>"><span class="badge bg-main badge-success fw-500 p-2 mr-1"># <?= $tag; ?></span></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="content mt-5">
                    <img class=" b-10 w-100" src="<?= Utils::baseUploadsthumbnail($model->thumbnail); ?>" alt="">
                    <div class="mt-5">
                        <?= ($model->content) ?>
                    </div>
                </div>
            </div>

            <br><br>

            <div class="card card-body b-10">
                <div id="disqus_thread"></div>
            </div>

        </div>
        <div class="col-lg-3">
            <div class="related">
                <p class="blockquote-footer"> Source Title</p>
                <div class=" my-2">
                    <div class="related-article">
                        <?php foreach ($related as $a) : ?>
                            <div class="items p-0">
                                <div class=" card card-body b-10 my-2">
                                    <div class="card-img">
                                        <a href="<?= Url::to(['/article/detail', 'id' => $a['slug']]); ?>">
                                            <img class="thumbnail b-10 w-100" src="<?= Utils::baseUploadsthumbnail($a->thumbnail); ?>" alt="" class="b-10">
                                        </a>
                                    </div>
                                    <div class="title mt-3">
                                        <a href="<?= Url::to(['/article/detail', 'id' => $a['slug']]); ?>">
                                            <p class="m-0"><b><?= $a->title; ?></b></p>
                                        </a>
                                        <small class="text-muted sub-title">
                                            <?= substr($a->subtitle, 0, 125) . ' . . . . .'; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</article>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>

<script>hljs.highlightAll();</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php JSRegister::begin() ?>
<script>
    $(document).ready(function() {
        // Highlight all code blocks
        // Select elements with class containing 'language-'
        $('pre[class*="language-"]').each(function() {
            // Create a card above each code block
            var className = $(this).attr('class');
            className = className.split('-');
            $(this).css("margin-top", "0px");
            $(this).css("border-top-left-radius", "0px");
            $(this).css("border-top-right-radius", "0px");
            $(this).before(`<div class="code-header-container">${className[1]} <div class="copy-button"><li class="fa-regular fa-clipboard"></li>&nbsp; Copy code</div></div>`);

            // Define code text to copy
            var codeText = $(this).text();

            // Bind copy functionality to the newly created button
            $(this).prev('.code-header-container').find('.copy-button').click(function() {
                var copyButton = $(this);
                // Reference to the button
                var tempTextarea = $('<textarea>');
                // tempTextarea
                $(this).html('<li class="fa-solid fa-check"></li>&nbsp; Copied!');
                tempTextarea.text(codeText);
                $('body').append(tempTextarea);

                // Select and copy the text inside the temporary textarea
                tempTextarea.select();
                document.execCommand('copy');

                // Remove the temporary textarea from the DOM
                tempTextarea.remove();

                // Alert the user that the text has been copied
                setTimeout(function() {
                    // Set the text of the button back to "Copy Code"
                    copyButton.html('<li class="fa-regular fa-clipboard"></li>&nbsp; Copy Code');
                }, 4000);
                // Alert the user that the text has been copied
            });

        });
    });
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */

    $('#bookmark').click(function() {
        var id = $(this).attr('data');
        var $icon = $(this).find('i');

        $.ajax({
            url: '<?= Url::to(['article/bookmark']) ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                var isbookmark = JSON.parse(data);
                console.log(isbookmark);
                if (isbookmark == 1) {
                    $icon.removeClass('fa-regular fa-bookmark').addClass('fa-solid fa-bookmark');
                } else {
                    $icon.removeClass('fa-solid fa-bookmark').addClass('fa-regular fa-bookmark');
                }
            }
        })

    })
    $('#heart').click(function() {
        var id = $(this).attr('data');
        var $icon = $(this).find('i');

        $.ajax({
            url: '<?= Url::to(['article/like']) ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                var isbookmark = JSON.parse(data);
                console.log(isbookmark);
                if (isbookmark == 1) {
                    $icon.removeClass('fa-regular fa-hearth').addClass('fa-solid fa-hearth');
                } else {
                    $icon.removeClass('fa-solid fa-hearth').addClass('fa-regular fa-hearth');
                }
            }
        })
    })
    $('#thumbs-down').click(function() {
        var id = $(this).attr('data');
        var $icon = $(this).find('i');

        $.ajax({
            url: '<?= Url::to(['article/like']) ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                var isbookmark = JSON.parse(data);
                console.log(isbookmark);
                if (isbookmark == 1) {
                    $icon.removeClass('fa-regular fa-thumbs-down').addClass('fa-solid fa-thumbs-down');
                } else {
                    $icon.removeClass('fa-solid fa-thumbs-down').addClass('fa-regular fa-thumbs-down');
                }
            }
        })
    })
</script>
<?php JSRegister::end() ?>