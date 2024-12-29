<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>

<main>
    <section class="no-pd-xl--y">
        <div class="no-pd-xl--y">
            <div class="no-container-md">
                <div class="no-auth-top">
                    <h2 class="no-heading-lg --tac">회원가입</h2>
                </div>
                <div class="no-auth-content">
                    <form method="post" id="frm" class="no-auth-entry">
                        <div class="no-form-container --column">
                            <div class="no-form-group">
                                <label for="name" class="no-form-label">
                                    <span class="no-form-text">이름</span>
                                    <div class="no-form-control">
                                        <input type="text" name="name" id="name" placeholder="이름">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="phone" class="no-form-label">
                                    <span class="no-form-text">연락처</span>
                                    <div class="no-form-control">
                                        <input type="tel" name="phone" id="phone" placeholder="연락처">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="birth" class="no-form-label">
                                    <span class="no-form-text">생년월일</span>
                                    <div class="no-form-control">
                                        <input type="date" name="birth" id="birth" placeholder="생년월일">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="uid" class="no-form-label">
                                    <span class="no-form-text">아이디</span>
                                    <div class="no-form-control">
                                        <input type="text" name="uid" id="uid" placeholder="아이디">
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="upwd" class="no-form-label">
                                    <span class="no-form-text">비밀번호</span>
                                    <div class="no-form-control no-form-password">
                                        <input type="password" name="upwd" id="upwd" placeholder="비밀번호">
                                        <button type="button" class="no-pwd-eye" data-target="#upwd">
                                            <i class="fa-light fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="pwd_confirm" class="no-form-label">
                                    <span class="no-form-text">비밀번호 확인</span>
                                    <div class="no-form-control no-form-password">
                                        <input type="password" id="pwd_confirm" placeholder="비밀번호 확인">
                                        <button type="button" class="no-pwd-eye" data-target="#pwd_confirm">
                                            <i class="fa-light fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-chk">
                                <label for="agree-terms">
                                    <input type="checkbox" id="agree-terms">
                                    <div class="no-form-chk__box">
                                        <i class="fa-regular fa-check"></i>
                                    </div>
                                    <p>이용약관에 동의합니다.</p>
                                </label>
                                <button type="button" class="no-btn no-btn-size--sm">전문보기</button>
                            </div>
                            <div class="no-form-chk">
                                <label for="agree-privacy">
                                    <input type="checkbox" id="agree-privacy">
                                    <div class="no-form-chk__box">
                                        <i class="fa-regular fa-check"></i>
                                    </div>
                                    <p>개인정보 수집 및 이용에 동의합니다.</p>
                                </label>
                                <button type="button" class="no-btn no-btn-size--sm">전문보기</button>
                            </div>
                            <div class="no-form-action --full --auth">
                                <button type="submit" class="no-btn no-btn-primary">
                                    <span>회원가입</span>
                                </button>
                            </div>
                            <div class="no-form-suggest --tac">
                                <p>이미 계정이 있으신가요? <a href="./login.php" class="no-link">
                                    로그인
                                </a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
