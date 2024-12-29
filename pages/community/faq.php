<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>


<main>
    <!-- <?= $this->renderOnlyView('components/local.visual.php') ; ?> -->

    <section class="no-pd-xl--y no-board">
        <div class="no-container-xl">
            <div class="no-content-top">
                <h2 class="no-heading-lg --tac">
                FAQ
                </h2>
            </div>
            <div class="no-pd-lg--t">
                <div class="no-board-top">
                    <div class="no-board-total">
                        총 <span class="--fw-bold">576</span>건
                    </div>
                    <div class="no-board-search">
                        <div class="no-board-search-inp">
                            <form>
                                <div class="no-form-group">
                                    <label for="search_term" class="no-form-label">
                                        <span class="no-form-text --blind">검색</span>
                                        <div class="no-form-search">
                                            <input type="text" name="search_term" id="search_term" placeholder="검색어를 입력해주세요.">
                                            <button type="submit" class="no-search-icon">
                                                <i class="fa-light fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="no-pd-md--t"></div>

                <div class="no-skin-faq">
                    <div class="no-skin-faq-container">
                        <ul class="no-skin-faq-list">
                            <?php for ($i = 0; $i < 14; $i++): ?>
                            <li class="no-skin-faq-item" data-faq-item>
                                <header class="no-skin-faq-head">
                                    <button type="button">
                                        <div class="no-skin-faq-item__title">
                                            <div class="no-skin-faq-item__icon">
                                                <span>Q</span>
                                            </div>
                                            <h3 class="no-body-xl --fw-semibold --tal">
                                            대학생이라면 누구나 지원할 수 있나요?
                                            </h3>
                                        </div>
                                        <span class="no-skin-faq-item__arrow">
                                            <i class="fa-light fa-chevron-down"></i>
                                        </span>
                                    </button>
                                </header>
                                <section class="no-skin-faq-body">
                                    <div>
                                        <div class="no-skin-faq-item__icon --dark">
                                            <span>A</span>
                                        </div>
                                        <div class="no-skin-faq-body__content">
                                            네 재학생, 휴학생 상관없이 대학생이라면 누구나 지원 가능합니다! <br> 
                                            졸업유예 혹은 추가학기등의 정규학기가 아닐지라도 신분이 대학생이라면 누구나 지원이 가능합니다.
                                        </div>
                                    </div>
                                </section>
                            </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
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

