<?php
    $post = $this->post;
 ?>

<div class="post">
    <div class="post-head-title">
        <h1><?= $post['title']?></h1>
    </div>
    <div class="post-head">
        <a class="image" href="https://www.miss-thrifty.co.uk/author/missthrifty/"><img alt="" src="https://secure.gravatar.com/avatar/a9443ce9d0cd7ea643f6f0b717218f6b?s=51&amp;d=mm&amp;r=g"
                srcset="https://secure.gravatar.com/avatar/a9443ce9d0cd7ea643f6f0b717218f6b?s=102&amp;d=mm&amp;r=g 2x"
                class="avatar avatar-51 photo" height="51" width="51"></a>
        <p><a href="<?= indexURL ?>index.php/user/profile/<?= $post['author_id'] ?>"><?= $post['author'] ?> </a><a href="https://www.miss-thrifty.co.uk/the-mythbusters-guide-to-saving-money-on-energy-bills/#respond"
                class="comments">(0) </a><span class="date"><?= $post['creationTime'] ?></span></p>
    </div>
    <div class="entry" data-content-ads-inserted="true">
        <?= $post['content'] ?>
    </div>


        <style type="text/css">
            #zergnet-widget-51973 .zergentity {
                width: 23.5% !important;
                margin-bottom: 15px !important;
                margin-left: 2% !important;
            }

            #zergnet-widget-51973 .zerglayoutcl {
                width: 100% !important;
            }

            #zergnet-widget-51973 .zergheadline {
                width: 100% !important;
                margin-top: 6px !important;
                text-align: left !important;
            }

            #zergnet-widget-51973 .zergheadline a {
                font-family: Arial !important;
            }

            #zergnet-widget-51973 .zergentity img {
                width: 100% !important;
                -ms-transform: translateY(12.5%);
                -webkit-transform: translateY(12.5%);
                transform: translateY(12.5%);
                height: auto !important;
            }

            #zergnet-widget-51973 .zergentity>a {
                display: block;
                margin-top: -25% !important;
                overflow: hidden;
            }

            #zergnet-widget-51973 .zergentity:nth-of-type(1) {
                margin-left: 0 !important;
            }

            #zergnet-widget-51973 .zergheader {
                font-size: 20px;
                font-weight: bold;
                color: #000000;
                margin-bottom: 2px;
                font-family: arial;
            }

            @media (max-width: 999px) {
                #zergnet-widget-51973 .zergentity:nth-of-type(4) {
                    display: none !important;
                }

                #zergnet-widget-51973 .zergentity {
                    width: 32% !important;
                }
            }

            @media (max-width: 600px) {
                #zergnet-widget-51973 .zergentity {
                    margin-left: 0 !important;
                    width: 100% !important;
                    clear: both !important;
                    margin-bottom: 10px !important;
                }
            }
        </style>
    </div>
</div>