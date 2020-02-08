<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="container post-page main-content">
    <div class="row">
        <div class="col-md-12 col-lg-8 col-sm-12 article-page content-area">
            <main>
                <header class="entry-header">
                    <h1 class="entry-title p-name" itemprop="name headline">
                        <a itemprop="url" href="<?php $this->permalink() ?>" rel="bookmark"><?php $this->title(); ?></a>
                    </h1>
                </header>
                <?php if ($this->options->headerImage && in_array('post', $this->options->headerImage)): ?>
                    <?php $img = postImg($this); ?>
                    <?php if ($img): ?>
                        <div class="header-img border-top">
                            <a tabindex="-1" aria-hidden="true" href="<?php $this->permalink() ?>" aria-label="<?php $this->title() ?>的头图" style="background-image: url(<?php echo $img; ?>);background-color: <?php echo headerImageBgColor($this->options->headerImageBg); ?>;"></a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="article-info clearfix border-bottom border-top">
                    <!--时间-->
                    <div class="info">
                        <i class="icon-calendar icon" aria-label="日期图标"></i>
                        <span data-toggle="tooltip" data-placement="top" tabindex="0" title="发布时间：<?php $this->date('Y年m月d日'); ?>"><?php $this->date('Y年m月d日'); ?></span>
                    </div>
                    <!--作者-->
                    <div class="info">
                        <i class="icon-user icon" aria-hidden="true"></i>
                        <a data-toggle="tooltip" data-placement="top" href="<?php $this->author->permalink(); ?>" title="作者：<?php $this->author(); ?>"><?php $this->author(); ?></a>
                    </div>
                    <!--阅读量-->
                    <div class="info">
                        <i class="icon-eye icon" aria-hidden="true"></i>
                        <span data-toggle="tooltip" data-placement="top" tabindex="0" title="阅读量：<?php echo getPostView($this); ?>"><?php echo getPostView($this); ?></span>
                    </div>
                    <!--评论-->
                    <div class="info">
                        <i class="icon-bubbles2 icon" aria-hidden="true"></i>
                        <a data-toggle="tooltip" data-placement="top" title="评论" href="#comments"><?php $this->commentsNum('%d 评论'); ?></a>
                    </div>
                    <!--分类-->
                    <div class="info">
                        <i class="icon-folder-open icon" aria-hidden="true"></i>
                        <?php $this->category(','); ?>
                    </div>
                    <!--标签-->
                    <div class="info tags">
                        <i class="icon-price-tags icon" aria-hidden="true"></i>
                        <?php $this->tags(' ', true, 'none'); ?>
                    </div>
                    <?php if ($this->user->hasLogin()): ?>
                        <div class="info d-sm-none d-none d-md-inline d-lg-inline d-xl-inline">
                            <i class="icon icon-pencil"></i>
                            <a href="<?php echo $this->options->siteUrl . 'admin/write-post.php?cid=' . $this->cid; ?>" >编辑</a>
                        </div>
                    <?php endif; ?>
                </div>
                <!--文章内容-->
                <article>
                    <div class="post-content">
                        <?php $this->content(); ?>
                        <?php if ($this->fields->articleCopyright != 'hide'): ?>
                            <hr>
                            <blockquote>
                                版权声明：本文为原创文章，版权归 <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> 所有，转载请联系博主获得授权！
                                <br>
                                本文地址：<a href="<?php $this->permalink(); ?>"><?php $this->permalink(); ?></a>
                            </blockquote>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix">
                        <?php if ($this->options->modified): ?>
                            <span class="float-xl-left float-lg-left float-md-left d-block" data-toggle="tooltip" data-placement="top" tabindex="0" title="发布时间：<?php $this->date('Y年m月d日'); ?>">最后编辑：<?php echo date('Y年m月d日', $this->modified);?></span>
                        <?php endif; ?>
                        <span class="float-xl-right float-lg-right float-md-right d-block">著作权归作者所有</span>
                    </div>
                    <div class="pt-3 text-center">
                        <button type="button" class="btn btn-outline-secondary mr-2">
                            <i class="icon-thumbs-up"></i>
                            <span>赞</span>
                            <span>12</span>
                        </button>
                        <button id="share-btn" data-url="<?php $this->permalink(); ?>" type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#share-box">
                            <i class="icon-share2"></i>
                            <span>分享</span>
                        </button>
                    </div>
                </article>
                <!--上一篇和下一篇文章的导航-->
                <nav class="post-navigation navbar border-top">
                    <div><div>上一篇</div><?php $this->thePrev('%s','没有了'); ?></div>
                    <div><div class="text-lg-right text-xl-right text-md-right">下一篇</div><?php $this->theNext('%s','没有了'); ?></div>
                </nav>
                <?php $this->need('comments.php'); ?>
            </main>
        </div>
        <?php $this->need('sidebar.php'); ?>
    </div>
</div>
<div id="max-img">
    <img src="" alt="" title="再次点击可关闭" class="shadow-lg">
    <div class="hide-img" role="button" aria-label="关闭大图" title="关闭大图" tabindex="0">×</div>
</div>
<div class="modal fade bd-example-modal-sm" id="share-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">分享</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="关闭">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="qrcode" class="mb-2"></div>
                <p>用微信扫一扫点击右上角分享</p>
                <div>
                    <a target="_blank" href="https://service.weibo.com/share/share.php?url=<?php $this->permalink(); ?>&title=<?php $this->title(); ?>" class="btn btn-danger btn-block">
                        <i class="icon-sina-weibo"></i>
                        <span>分享到新浪微博</span>
                    </a>
                    <a target="_blank" href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink(); ?>&title=<?php echo $this->title(); ?>&site=<?php $this->options->siteUrl(); ?>&summary=<?php $this->fields->summaryContent?$this->fields->summaryContent():$this->excerpt($this->options->summary, '...'); ?>" class="btn btn-primary btn-block">
                        <i class="icon-qzone"></i>
                        <span>分享到QQ空间</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>
