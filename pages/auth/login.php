<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>


<main>
    <section class="no-pd-xl--y">
        <div class="no-pd-xl--y">
            <div class="no-container-md">
                <div class="no-auth-top">
                    <h2 class="no-heading-lg --tac">로그인</h2>
                </div>
                <div class="no-auth-content">
                    <form method="post" id="frm" class="no-auth-entry">
                        <div class="no-form-container --column">
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
                            <div class="no-form-action --full --auth">
                                <button type="submit" class="no-btn no-btn-primary">
                                    <span>로그인</span>
                                </button>
                            </div>
                            <div class="no-form-suggest --tac">
                                <p>계정이 없으신가요? <a href="./signup.php" class="no-link">회원가입</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

