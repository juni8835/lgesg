<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>


<main>
    <!-- <?= $this->renderOnlyView('components/local.visual.php') ; ?> -->

    <section class="no-pd-xl--y no-board">
        <div class="no-container-xl">
            <div class="no-content-top">
                <h2 class="no-heading-lg --tac">
                Q&amp;A
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

                <div class="no-skin-list">
                    <div class="no-skin-list-table-container">
                        <table class="no-skin-list-table">
                            <colgroup>
                                <col style="width: 8%;">
                                <col style="width: 52%">
                                <col style="width: 14%;">
                                <col style="width: 12%;">
                                <col style="width: 14%;">
                            </colgroup>
                            <thead>
                                <tr class="no-body-lg --fw-semibold">
                                    <th>번호</th>
                                    <th class="--tal">제목</th>
                                    <th>답변여부</th>
                                    <th>작성자</th>
                                    <th>등록일</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 4; $i++) : ?>
                                <tr>
                                    <td>
                                        <span class="no-clr-text-label">5</span>
                                        <!-- <span class="no-notice-megaphone">
                                            <i class="fa-solid fa-megaphone"></i>
                                        </span> -->
                                    </td>
                                    <td class="--tal --full">
                                        <a href="" class="no-clr-text-title no-body-lg --fw-semibold">
                                            <div class="no-skin-lock">
                                                <i class="fa-light fa-lock-keyhole"></i>
                                            </div>
                                            <strong>
                                            LG전자 ESG 대학생 아카데미 11기 모집 최종 합격자 결과 발표 안내
                                            </strong>
                                        </a>
                                    </td>
                                    <td class="no-skin-list-table__label">
                                        <span class="no-begde">답변완료</span>
                                    </td>
                                    <td class="no-skin-list-table__label">
                                        <span class="no-clr-text-label" data-label="조회수">
                                        1500
                                        </span>
                                    </td>
                                    <td class="no-skin-list-table__label">
                                        <span class="no-clr-text-label" data-label="등록일">
                                        2025-02-21
                                        </span>
                                    </td>
                                </tr>
                                <?php endfor ?>
                            </tbody>
                        </table>
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
