<?php include_once $_SERVER['DOCUMENT_ROOT'].'/app/boot.php'; ?>

<main>
    <section class="no-pd-xl--y">
        <div class="no-container-md no-pd-xl--y">
            <div class="no-auth-profile-img">
                <?php 
                    $imgSrc = "https://images.unsplash.com/photo-1505033575518-a36ea2ef75ae?q=80&w=1286&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"; 
                ?>
                <?php if($imgSrc) : ?>
                <img src="<?=$imgSrc?>" alt="">
                <?php else : ?>  
                    <i class="fa-light fa-user"></i>
                <?php endif; ?>
            </div>
            <div class="no-content-top no-pd-md--t">
                <h2 class="no-heading-md --tac">
                    홍길동
                </h2>
            </div>
            <div class="no-pd-lg--t">
                <div class="no-auth-profile-tabs" id="profile-tabs">
                    <button type="button" class="--active">
                        <span>프로필 수정</span>
                    </button>
                    <button type="button">
                        <span>비밀번호 변경</span>
                    </button>
                    <button type="button">
                        <span>Q&amp;A</span>
                    </button>
                    <button type="button">
                        <span>모집신청</span>
                    </button>
                </div>
            </div>
            <div class="no-auth-profile-wrapper">
                <div class="no-auth-profile-block">
                    <form method="post" id="frm">
                        <div class="no-form-container">
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
                                <label for="birth" class="no-form-label">
                                    <span class="no-form-text">생년월일</span>
                                    <div class="no-form-control">
                                        <input type="date" name="birth" id="birth" placeholder="생년월일">
                                    </div>
                                </label>
                            </div>

                            <div></div>
                            <div></div>
                            
                            <div class="no-form-action --end no-mg-lg--t">
                                <button type="button" class="no-btn no-btn-error-outline">
                                    <span>회원탈퇴</span>
                                </button>
                                <button type="submit" class="no-btn no-btn-primary">
                                    <span>수정</span>
                                </button>
                            </div>
                        </div>
                    </form>   
                </div>

                <div class="no-auth-profile-block">
                    <form method="post" id="pwd-form">
                        <div class="no-form-container">
                            <div class="no-form-group">
                                <label for="upwd" class="no-form-label">
                                    <span class="no-form-text">새 비밀번호</span>
                                    <div class="no-form-control no-form-password">
                                        <input type="password" name="upwd" id="upwd" placeholder="새 비밀번호">
                                        <button type="button" class="no-pwd-eye" data-target="#upwd">
                                            <i class="fa-light fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </label>
                            </div>
                            <div class="no-form-group">
                                <label for="pwd_confirm" class="no-form-label">
                                    <span class="no-form-text">새 비밀번호 확인</span>
                                    <div class="no-form-control no-form-password">
                                        <input type="password" id="pwd_confirm" placeholder="새 비밀번호 확인">
                                        <button type="button" class="no-pwd-eye" data-target="#pwd_confirm">
                                            <i class="fa-light fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </label>
                            </div>

                            <div></div>
                            
                            <div class="no-form-action --end no-mg-lg--t">
                                <button type="submit" class="no-btn no-btn-primary">
                                    <span>변경</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="no-auth-profile-block">
                    <!-- <div class="no-auth-profile-qna">
                        <ul class="no-auth-profile-qna-list">
                            <li class="no-auth-profile-qna-item">
                                <a href="#">
                                    <span>2024-09-01</span>
                                    <strong class="no-body-xl">
                                    서류 제출시 꼭 포트폴리오를 제출해야하나요?
                                    </strong>
                                </a>
                            </li>
                            <li class="no-auth-profile-qna-item">
                                <a href="#">
                                    <span>2024-09-01</span>
                                    <strong class="no-body-xl">
                                    서류 제출시 꼭 포트폴리오를 제출해야하나요?
                                    </strong>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <div class="no-auth-not-found --tac">
                        <p>등록된 글이 없습니다.</p>
                        <div class="no-pd-sm--t --flex-center">
                            <a href="<?=$MENU_ITEMS[3]['pages'][2]['path']?>" class="no-btn no-btn-primary">
                                문의하러가기 
                            </a>
                        </div>
                    </div>
                </div>
                <div class="no-auth-profile-block">
                    <div class="no-auth-not-found --tac">
                        <p>신청내역이 없습니다.</p>
                        <div class="no-pd-sm--t --flex-center">
                            <a href="<?=$MENU_ITEMS[1]['pages'][0]['path']?>" class="no-btn no-btn-primary">
                                신청하러가기
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
