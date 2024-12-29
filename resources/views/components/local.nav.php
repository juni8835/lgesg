<nav class="no-local-nav" >
    <div class="no-container-xl">
        <div class="no-local-nav__inner">
            <div class="no-local-nav__block no-local-nav-home">
                <a href="" aria-label="홈으로">
                    <i class="fa-light fa-house"></i>
                </a>
            </div>

            <div class="no-local-nav__block no-local-nav-dropdown">
                <button type="button">
                    <span><?=$CUR_PAGE_LIST[0]['title']?></span>
                    <i class="fa-light fa-chevron-down"></i>
                </button>
                <ul>
                    <?php foreach ($MENU_ITEMS as $depthIdx => $depthItem) : 
                        $isActive = $CUR_PAGE_LIST[0]['title'] === $depthItem['title'] ? ' active' : ''; 
                    ?>
                    <li class="no-local-nav__item<?=$isActive?>">
                        <a href="<?=$depthItem['path']?>"><?=$depthItem['title']?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            
            <?php if(isset($CUR_PAGE_LIST[0]['pages'])) : ?>
            <div class="no-local-nav__block no-local-nav-dropdown">
                <button type="button">
                    <span><?=$CUR_PAGE_LIST[1]['title']?></span>
                    <i class="fa-light fa-chevron-down"></i>
                </button>
                <ul>
                    <?php foreach ($CUR_PAGE_LIST[0]['pages'] as $pageIdx => $pageItem) : 
                        $isActive = $CUR_PAGE_LIST[1]['title'] === $pageItem['title'] ? ' active' : ''; 
                    ?>
                    <li class="no-local-nav__item<?=$isActive?>">
                        <a href="<?=$pageItem['path']?>"><?=$pageItem['title']?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</nav>