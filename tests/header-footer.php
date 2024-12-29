
<!-- <div id="go-to-top">
    <button type="button">
        <span>TOP</span>
        <i class="fa-light fa-arrow-up-long"></i>
    </button>
</div>

<footer id="footer" class="no-footer no-pd-lg--y">
    <div class="no-container-xl">
        <div class="no-footer-inner">
            <div class="no-footer-inner-top">
                <div class="no-flogo">
                    <a href="<?=$ROOT?>/">
                        <img src="<?=$ROOT?>/resource/images/meta/lg-logo.svg" alt="LG">
                    </a>
                </div>
                <div class="no-footer-info">
                    <div class="no-footer-legal no-body-md">
                        <a href="<?=$ROOT?>/pages/legal/terms.php" class="no-link">이용약관</a>
                        <a href="<?=$ROOT?>/pages/legal/privacy.php" class="no-link">개인정보처리방침</a>
                        <a href="<?=$ROOT?>/pages/legal/info.php" class="no-link">사업자정보확인</a>
                    </div>
                    <address class="no-body-md">
                        <dl>
                            <dt>회사명: </dt>
                            <dd>LG전자 ESG 대학생 아카데미 </dd>
                        </dl>
                        <dl>
                            <dt>대표이사: </dt>
                            <dd>주정헌</dd>
                        </dl>
                        <dl>
                            <dt>사업자등록번호: </dt>
                            <dd>120-87-93240</dd>
                        </dl>
                        <dl>
                            <dt>주소: </dt>
                            <dd>서울 강남구 논현로 102길 19 LG전자 ESG 대학생 아카데미 운영사무국</dd>
                        </dl>
                        <dl>
                            <dt>연락처: </dt>
                            <dd>070-4681-6129</dd>
                        </dl>
                        <dl>
                            <dt>이메일: </dt>
                            <dd>lgeesgacademy@naver.com</dd>
                        </dl>
                    </address>
                    <small class="no-body-sm">
                    Copyright &copy; <?=date('Y')?> LG ESG Academy. All Rights Reserved.
                    </small>
                </div>
            </div>
            <div>
            <?php include $STATIC_ROOT . '/inc/shared/sns.php'; ?>
            </div>
        </div>
    </div>
</footer> -->



<!-- <header id="header" class="no-header">
        <div class="no-container-xl">
            <div class="no-header-inner">
                <h1 class="no-logo">
                    <a href="<?=$ROOT?>/">
                        <img src="<?=$ROOT?>/resource/images/meta/logo.svg" alt="LG ESG 아카데미">
                    </a>
                </h1>
                <nav class="no-header-nav">
                    <ul class="no-gnb">
                    <?php foreach ($MENU_ITEMS as  $depthIdx => $depthItem) : 
                            $depthIsActive = $depthItem['isActive'] ? ' active' : '';     
                        ?>
                        <li class="no-gnb-item<?=$depthIsActive?>">
                            <a href="<?=$depthItem['path']?>" class="no-gnb-link">
                                <span><?=$depthItem['title']?></span>
                            </a>

                            <?php if(isset($depthItem['pages'])) : ?>
                            <div class="no-lnb-block">
                                <ul class="no-lnb">
                                    <?php foreach($depthItem['pages'] as $pageIdx => $pageItem) : 
                                        $pageIsActive = $pageItem['isActive'] ? ' active' : '';      
                                    ?>
                                    <li class="no-lnb-item<?=$pageIsActive?>">
                                        <a href="<?=$pageItem['path']?>" class="no-lnb-link">
                                            <?=$pageItem['title']?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach ;?>
                    </ul>
                </nav>

                
                <?php include $STATIC_ROOT . '/inc/shared/sns.php'; ?>
                
                <div class="no-header-toggle">
                    <button type="button" id="menu-btn" title="메뉴열기">
                        <i class="fa-light fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="no-lnb-surface"></div>
    </header>

    <div id="mobile-menu" class="no-m-menu">
        <div class="no-m-menu-container">
            <div class="no-m-menu-inner" data-lenis-prevent>
                <nav class="no-m-menu-nav">
                    <ul class="no-gnb">
                        <?php foreach ($MENU_ITEMS as  $depthIdx => $depthItem) : 
                            $depthIsActive = $depthItem['isActive'] ? ' active' : '';     
                        ?>
                        <li class="no-gnb-item<?=$depthIsActive?>">
                            <a href="<?=$depthItem['path']?>" class="no-gnb-link">
                                <span><?=$depthItem['title']?></span>
                            </a>

                            <?php if(isset($depthItem['pages'])) : ?>
                            <div class="no-lnb-block">
                                <ul class="no-lnb">
                                    <?php foreach($depthItem['pages'] as $pageIdx => $pageItem) : 
                                        $pageIsActive = $pageItem['isActive'] ? ' active' : '';      
                                    ?>
                                    <li class="no-lnb-item<?=$pageIsActive?>">
                                        <a href="<?=$pageItem['path']?>" class="no-lnb-link">
                                            <?=$pageItem['title']?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach ;?>
                    </ul>
                </nav>
                
                <div class="no-m-menu-auth">
                    <a href="<?=$ROOT?>/pages/auth/login.php" class="no-btn no-btn-primary">
                        <span>로그인</span>
                    </a>
                    <a href="<?=$ROOT?>/pages/auth/signup.php" class="no-btn">
                        <span>회원가입</span>
                    </a>
                </div>
                
                <?php include $STATIC_ROOT . '/inc/shared/sns.php'; ?>

                <button type="button" class="no-m-menu-close" id="mobile-menu-close" aria-label="메뉴닫기">
                    <i class="fa-light fa-xmark"></i>
                </button>
            </div>
        </div>
        <div class="no-m-menu-overlay" id="mobile-overlay"></div>
    </div> -->