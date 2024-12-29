<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>

<main>
    <!-- <?= $this->renderOnlyView('components/local.visual.php') ; ?> -->

    <section class="no-pd-xl--y no-main-about">
        <div class="no-container-2xl">
            <div class="no-content-top">
                <h2 class="no-heading-lg --tac">
                    신청하기
                </h2>
                <p class="no-pd-xs--t no-clr-base-desc no-body-xl ">
                </p>
            </div>
            <div class="no-pd-lg--t">
                <div class="no-process-nav">
                    <div class="no-process-nav__item --active">
                        <em>Step 01</em>
                        <span>정보 입력</span>
                        <i class="fa-light fa-chevron-right"></i>
                    </div>
                    <div class="no-process-nav__item">
                        <em>Step 02</em>
                        <span>활동 입력</span>
                        <i class="fa-light fa-chevron-right"></i>
                    </div>
                    <div class="no-process-nav__item">
                        <em>Step 03</em>
                        <span>본인 어필</span>
                        <i class="fa-light fa-chevron-right"></i>
                    </div>
                    <div class="no-process-nav__item">
                        <em>Step 04</em>
                        <span>지원 완료</span>
                    </div>
                </div>

                <div class="no-process-alert no-pd-lg--t">
                    <div class="no-process-alert__danger">
                        ※ 상기 모든 내용은 2025년 1학기 현 상태 기준으로 기재 바라며, 만약 사실과 다를 경우 합격이 취소 될 수 있습니다. 
                        <br>
                        ※ 제출 후에는 수정이 불가능합니다. 최종 제출 전 임시저장을 활용하여 오기입 없이 작성 부탁드립니다
                    </div>
                    <div class="no-process-alert__between no-pd-sm--t">
                        <div>
                            <i class="no-required-dot"></i>
                            <span>표시는 반드시 입력하셔야 하는 항목입니다.</span>
                        </div>
                        <small>
                        임시저장본 시간 : 2025/02/19 14:05:37
                        </small>
                    </div>
                </div>

                <form method="post" id="frm" class="no-mg-sm--t">
                    <div class="no-form-box">
                        <div class="no-form-container">
                            <div class="no-form-group">
                                <label for="name" class="no-form-label">
                                    <span class="no-form-text">성명 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="name" id="name" placeholder="이름">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="phone" class="no-form-label">
                                    <span class="no-form-text">증명사진 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="tel" name="phone" id="phone" placeholder="연락처">
                                    </div>
                                </label>
                            </div>
                            
                            <div class="no-form-group">
                                <div for="uid" class="no-form-label">
                                    <span class="no-form-text">성별 <i class="no-required-dot"></i></span>
                                
                                    <div class="no-form-radio">
                                        <label for="gender_m">
                                            <input type="radio" name="gender" id="gender_m" value="M">
                                            <div class="no-form-radio__box">
                                                <span></span>
                                            </div>
                                            <span>남</span>
                                        </label>
                                        <label for="gender_f">
                                            <input type="radio" name="gender" id="gender_f" value="F">
                                            <div class="no-form-radio__box">
                                                <span></span>
                                            </div>
                                            <span>여</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="no-form-group">
                                <label for="birth" class="no-form-label">
                                    <span class="no-form-text">생년월일 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="date" name="birth" id="birth" placeholder="생년월일">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">학교(소재) <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">학년학기 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                        <div class="no-form-feedback">
                                            <i class="fa-solid fa-circle-info"></i>
                                            <span>25년 3월 기준</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">전공학과 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">상태 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">연락처 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">복수전공</span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                        <div class="no-form-feedback">
                                            <i class="fa-solid fa-circle-info"></i>
                                            <span>없다면 공란으로 제출</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group --full">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">주소 <i class="no-required-dot"></i></span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                    </div>
                                </label>
                            </div>

                            <div class="no-form-group --full --flex-end">
                                <button type="button" class="no-link-active">임시글로 저장하기</button>
                            </div>
                        </div>
                        
                    </div>

                    <div class="no-pd-md--t">
                        <div class="no-form-action --full --auth">
                            <!-- <button type="submit" class="no-btn no-btn-primary">
                                <span>이전</span>
                            </button> -->
                            <button type="submit" class="no-btn no-btn-primary">
                                <span>다음</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include_once $STATIC_ROOT . '/inc/layouts/footer.php'; ?>