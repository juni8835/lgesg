<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>


<main>
    <!-- <?= $this->renderOnlyView('components/local.visual.php') ; ?> -->

    <section class="no-pd-xl--y no-board">
        <div class="no-container-xl">
            <div class="no-content-top">
                <h2 class="no-heading-lg --tac">
                PHOTO
                </h2>
            </div>
            <div class="no-pd-lg--t">
                <div class="no-skin-video">
                    <ul class="no-row no-row-gap">
                        <?php for ($i = 0; $i < 12; $i++) : ?>
                        <li class="no-col-4 no-col-lg-6 no-col-md-12">
                            <a href="#" class="no-skin-video__link">
                                <figure class="no-skin-video__img">
                                    <img src="<?=$ROOT?>/resource/images/main/main_banner.jpg" alt="">
                                </figure>
                                <div class="no-skin-video__content no-pd-sm--t">
                                    <h3 class="f-body-xl --fw-semibold">
                                    추억 가득 열정 가득 마지막 이야기, LG전자 ESG 대학생 아카데미 수료식 현장
                                    </h3>
                                </div>
                            </a>
                        </li>
                        <?php endfor ?>
                    </ul>
                </div>

                <div class="no-pd-lg--t">
                    <nav class="no-pagination">
                        <a href="#" class="no-pagination__arrow">
                            <i class="fa-light fa-chevrons-left"></i>
                        </a>
                        <a href="#" class="no-pagination__arrow">
                            <i class="fa-light fa-chevron-left"></i>
                        </a>

                        <div class="no-pagination__num">
                            <a href="#" class="no-pagination__link">
                                <span>1</span>
                            </a>
                            <a href="#" class="no-pagination__link --active">
                                <span>2</span>
                            </a>
                            <a href="#" class="no-pagination__link">
                                <span>3</span>
                            </a>
                            <a href="#" class="no-pagination__link">
                                <span>4</span>
                            </a>
                            <a href="#" class="no-pagination__link">
                                <span>5</span>
                            </a>
                        </div>

                        <a href="#" class="no-pagination__arrow">
                            <i class="fa-light fa-chevron-right"></i>
                        </a>
                        <a href="#" class="no-pagination__arrow">
                            <i class="fa-light fa-chevrons-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</main>
