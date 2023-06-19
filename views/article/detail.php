<?php

use app\helpers\Utils;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */
$tag = explode(', ', $model->tag);

$this->title = $model->title;
// $this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$c_bookmark = $bookmark == 'true' ? 'fa-solid' : 'fa-regular';
$c_like = $like == 'true' ? 'fa-solid' : 'fa-regular';
// echo '<pre>';print_r($urlfrom);die;
?>
<style>
    article {
        margin-top: 2.5rem;
    }

    @media (max-width:767px) {
        .utils-action {
            width: 40px !important;
            height: 40px !important;
            margin-right: 1.2rem !important;
            outline: 5px white solid !important;

        }

        .article-card {
            padding: 1rem !important;
        }

        .related {
            margin-top: 2rem;
        }

        .items {
            flex: 0 0 50%;
        }

        .related-article {
            gap: 1rem;
            height: fit-content !important;
            display: flex !important;
            overflow-y: hidden;
            overflow-x: auto;
            padding-right: 1rem;
        }

        .related-article .items {
            min-height: 66.6% !important;
        }

    }

    h1 {
        font-weight: 900;
    }

    .hr {
        margin: 0;
    }

    .badge {
        width: fit-content;
    }

    .tag {
        display: flex;
    }

    .related-article {
        height: 100vh;
        overflow-y: auto;
        padding-right: 1rem;
    }

    .related-article .card-body {
        min-height: auto !important;
    }

    .bookmarked {
        background-color: #7D94E2;
        color: white;
    }

    .article-card {
        padding: 3rem;
    }

    .utils {
        position: absolute;
        top: -25px;
        right: 0;

    }

    .utils-action {
        background: white;
        float: right;
        display: flex;
        padding: .7rem;
        border: 1px #7D94E2 solid;
        margin-right: 3rem;
        border-radius: 25px;
        outline: 10px white solid;
        width: 50px;
        height: 50px;
        align-items: center;
        justify-content: center;
    }

    pre {
        border-radius: 6px;
    }
</style>
<article class="article-view">
    <div class="row">
        <div class="col-lg-9">
            <div class="article-content card card-body  b-10">
                <div class="utils">
                    <div class="d-flex">
                        <a data="<?= $model->idarticle; ?>" id="bookmark" href="#"><i class="utils-action <?= $c_bookmark; ?> fa-bookmark"></i></a>
                        <a data="<?= $model->idarticle; ?>" id="heart" href="#"><i class="utils-action <?= $c_like; ?> fa-heart"></i></a>
                    </div>
                </div>
                <header>
                    <img src="<?= Utils::baseUploadsProfile($model->user->profile_picture); ?>" alt="" srcset="">
                    <small class="text-muted">Author : <?= $model->user->first_name . ' ' . $model->user->last_name . ' - ' . Yii::$app->formatter->asDate($model->created_at); ?></small>
                    <h1><?= $model->title; ?></h1>
                    <hr class="hr">
                    <div class="tag mt-3">
                        <?php foreach ($tag as $tag) : ?>
                            <a href="<?= Url::to(['/site/index?Article%5Bsearch%5D=' . $tag]); ?>"><span class="badge bg-main badge-success fw-500 p-2 mr-1"># <?= $tag; ?></span></a>
                        <?php endforeach ?>
                    </div>
                </header>
                <div class="content mt-5">
                    <img class=" b-10 w-100" src="<?= Utils::baseUploadsthumbnail($model->thumbnail); ?>" alt="">
                    <div class="mt-5">
                        <?= Html::decode($model->content) ?>
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
<script>

</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php JSRegister::begin() ?>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
        var d = document,
            s = d.createElement('script');
        s.src = 'https://readme-4.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();

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