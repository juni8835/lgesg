<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>


<main>
    <!-- <?= $this->renderOnlyView('components/local.visual.php') ; ?> -->

    <section class="no-pd-xl--y no-review">
        <div class="no-container-xl">
            <h2 class="--tac no-heading-lg">활동후기</h2>
            <div class="no-content-top --flex-center --flex-between no-review-top no-pd-lg--t">
                <h3 class="no-heading-md">
                러브지니 &amp; 엘지니가 <br>
                예비 엘지니들에게 남기는 활동 후기
                </h3>
                <div class="no-review-control">
                    <div class="no-review-buttons no-btn-wrap">
                        <button type="button" class="no-btn-control swiper-button-prev no-review-prev">
                            <i class="fa-light fa-arrow-left-long"></i>
                        </button>
                        <button type="button" class="no-btn-control swiper-button-next no-review-next">
                            <i class="fa-light fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="no-pd-lg--t --flex-center --flex-between">
                <ul class="no-main-archive-catg">
                    <button type="button" class="no-btn-size--sm no-btn no-btn-primary">전체</button>
                    <button type="button" class="no-btn-size--sm no-btn">VIDEO</button>
                    <button type="button" class="no-btn-size--sm no-btn">PHOTO</button>
                </ul>
            </div> -->
            <div class="no-pd-md--t">
                <div class="swiper" id="review-swiper">
                    <ul class="swiper-wrapper">
                        <?php for ($i =  0; $i < 10; $i++): ?>
                        <li class="swiper-slide">
                            <a href="#" class="no-review__link">
                                <div class="no-review-info">
                                    <i class="fa-solid fa-user"></i>
                                    <span>4기 홍길동</span>
                                </div>
                                <div class="no-review__content no-pd-sm--t">
                                    <h4 class="no-body-xl --fw-bold no-clr-text-title">
                                    [LG전자 ESG 대학생 아카데미] 8기 최종 합격 후기
                                    </h4>
                                    <p class="no-clr-text-desc no-body-md no-pd-sm--t">
                                    LG전자 ESG 대학생 아카데미가 첫 대외활동인만큼 부족한 점, 미숙한 점이 많았는데 엘지니 분들, 실무진 분들, 운영사무국 매니저 분들이..
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
