console.log("[app.js]");

gsap.registerPlugin(ScrollTrigger);

class Global {
    static ALLOWED_WINDOW_EVENTS = ["resize", "scroll"];
    constructor() {
        this.windowEvents = [];
        this.events = [];
        this.vars = {};
    }

    addVar(key, value) {
        this.vars[key] = value;
    }

    getVar(key) {
        return this.vars[key];
    }

    addWindowEvent(eventName, func) {
        if (!Global.ALLOWED_WINDOW_EVENTS.includes(eventName)) return;

        if (typeof func !== "function") {
            throw new Error(`callback must be type function: ${func}`);
        }

        this.windowEvents.push({ name: eventName, func: func });
    }

    addEvent(key, callback) {
        this.events.push({ name: key, func: callback });
    }

    listenWindowEvents() {
        const events = {};

        Global.ALLOWED_WINDOW_EVENTS.forEach((event) => {
            const list = this.windowEvents.filter(
                (item) => item.name === event
            );
            Object.assign(events, { [event]: list });
        });

        for (const key in events) {
            const callbacks = events[key];

            if (callbacks.length > 0) {
                window.addEventListener(key, (e) => {
                    callbacks.forEach((event) => {
                        event.func();
                    });
                });

                callbacks.forEach((event) => {
                    event.func();
                });
            }
        }
    }

    listenEvents() {
        this.events.forEach((event) => {
            console.log(`Global: [${event.name}] ${event.func.name}()`);
            event.func();
        });
    }

    listen() {
        this.listenEvents();
        this.listenWindowEvents();
    }
}

function initFaqItems() {
    const faqItems = [...document.querySelectorAll("[data-faq-item]")];

    if (!faqItems) return;

    faqItems.forEach((item) => {
        const head = item.querySelector("header button");
        const body = item.querySelector("section");

        $(head).click(function () {
            $(item).toggleClass("--active");
            $(body).stop().slideToggle(200);

            const siblings = $(item).siblings();

            siblings.removeClass("--active");
            siblings.find("section").stop().slideUp(200);
        });
    });
}

function initTabs() {
    const createTabMenu = (tabItemSelector, tabBlockSelector) => {
        const tabs = [...document.querySelectorAll(tabItemSelector)];
        const contents = [...document.querySelectorAll(tabBlockSelector)];

        if (tabs.length > 0 && tabs.length === contents.length) {
            tabs.forEach((tab, idx) => {
                tab.addEventListener("click", () => {
                    tabs.forEach((t, i) => {
                        t.classList.remove("--active");
                        contents[i].classList.remove("--active");
                    });

                    tab.classList.add("--active");
                    contents[idx].classList.add("--active");
                });
            });

            tabs[0].click();
        }
    };

    createTabMenu(
        ".no-auth-profile-tabs > button",
        ".no-auth-profile-wrapper > div"
    );
}

function initGoToTop() {
    const goToTop = document.querySelector("#go-to-top");

    if (goToTop) {
        const lenis = App.global.getVar("lenis");

        App.global.addWindowEvent("scroll", () => {
            if (window.scrollY > 0) {
                goToTop.classList.add("--active");
            } else {
                goToTop.classList.remove("--active");
            }
        });

        goToTop.addEventListener("click", () => {
            lenis.scrollTo(0);
        });
    }
}

function initAuth() {
    const pwdEyeButtons = [...document.querySelectorAll(".no-pwd-eye")];
    pwdEyeButtons.forEach((btn) => {
        const input = document.querySelector(btn.dataset.target);
        const icon = btn.querySelector("i");

        btn.addEventListener("click", () => {
            const inputType = input.type === "password" ? "text" : "password";
            const iconType =
                input.type === "password"
                    ? "fa-light fa-eye"
                    : "fa-light fa-eye-slash";

            input.type = inputType;
            icon.className = iconType;
        });
    });
}

function initLocalNav() {
    const navItems = [...document.querySelectorAll(".no-local-nav-dropdown")];
    navItems.forEach((item, idx) => {
        const btn = item.querySelector("button");

        btn.addEventListener("click", () => {
            navItems.forEach((navItem, itemIdx) => {
                if (itemIdx !== idx) {
                    navItem.classList.remove("--active");
                }
            });

            item.classList.toggle("--active");
        });
    });
}

function initHeader() {
    const header = document.querySelector("#header");

    if (!header) return;

    const lnbSurface = header.querySelector(".no-lnb-surface");
    const gnb = header.querySelector(".no-gnb");
    const gnbItems = [...gnb.querySelectorAll(".no-gnb-item")];
    const menuBtn = document.querySelector("#menu-btn");
    const mobileMenu = document.querySelector("#mobile-menu");
    const menuCloseBtn = document.querySelector("#mobile-menu-close");

    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.add("--active");
        document.body.classList.add("--hidden");
    });
    menuCloseBtn.addEventListener("click", () => {
        mobileMenu.classList.remove("--active");
        document.body.classList.remove("--hidden");
    });

    gnb.addEventListener("mouseenter", () => {
        lnbSurface.classList.add("--active");
    });
    gnb.addEventListener("mouseleave", () => {
        lnbSurface.classList.remove("--active");
    });

    gnbItems.forEach((item) => {
        const lnb = item.querySelector(".no-lnb-block");

        item.addEventListener("mouseenter", () => {
            item.classList.add("--hover");
            lnb.classList.add("--active");
        });
        item.addEventListener("mouseleave", () => {
            item.classList.remove("--hover");
            lnb.classList.remove("--active");
        });
    });

    App.global.addWindowEvent("scroll", () => {
        if (window.scrollY >= 0) {
            header.classList.add("--scroll");
        } else {
            header.classList.remove("--scroll");
        }
    });
    App.global.addWindowEvent("resize", () => {
        if (window.innerWidth > 1024) {
            mobileMenu.classList.remove("--active");
        }
    });
}

function initSwiper() {
    const mainSwiperTimelines = [];

    const mainSwiper = new Swiper("#main-banner", {
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
            renderBullet: function (index, className) {
                return `<div class="${className}"><span>${
                    index < 10 ? `0${index + 1}` : index + 1
                }</span></div>`;
            },
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        speed: 1000,
        autoplay: {
            delay: 5000,
            disableOnInteraction: true,
        },
        loop: true,
        on: {
            init: function () {
                this.slides.forEach((slide) => {
                    const content = slide.querySelector(".no-main-vis-content");
                    const title = content.querySelector("h2");
                    const desc = content.querySelector("p");
                    const tl = gsap
                        .timeline({ paused: true })
                        .to(title, {
                            y: 0,
                            autoAlpha: 1,
                            duration: 0.7,
                            ease: "power3.inOut",
                        })
                        .to(
                            desc,
                            {
                                y: 0,
                                autoAlpha: 1,
                                duration: 0.7,
                                ease: "power3.inOut",
                            },
                            "-=.15"
                        );

                    mainSwiperTimelines.push({
                        play: () => tl.play(),
                        reverse: () => tl.reverse(),
                    });
                });

                mainSwiperTimelines[this.realIndex].play();
            },
            slideChangeTransitionEnd: function () {
                mainSwiperTimelines.forEach((item, idx) => {
                    if (idx === this.realIndex) {
                        item.play();
                    } else {
                        item.reverse();
                    }
                });
            },
        },
    });

    const breakpoints = {
        320: {
            slidesPerView: 1,
            spaceBetween: 12,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 24,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 24,
        },
        1280: {
            slidesPerView: 4,
            spaceBetween: 24,
        },
    };

    const archiveSwiper = new Swiper("#archive-swiper", {
        navigation: {
            nextEl: ".no-archive-next",
            prevEl: ".no-archive-prev",
        },
        scrollbar: {
            el: ".no-main-archive-scrollbar",
        },
        spaceBetween: 24,
        slidesPerView: 4,
        breakpoints: breakpoints,
    });

    const reviewSwiper = new Swiper("#review-swiper", {
        navigation: {
            nextEl: ".no-review-next",
            prevEl: ".no-review-prev",
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: true,
        },
        speed: 750,
        spaceBetween: 24,
        slidesPerView: 4,
        slidesPerGroup: 4,
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 12,
                slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
                slidesPerGroup: 2,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
                slidesPerGroup: 3,
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 24,
                slidesPerGroup: 4,
            },
        },
    });
}

function initLenis() {
    const lenis = new Lenis();

    lenis.on("scroll", () => {
        ScrollTrigger.update();
    });

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    App.global.addVar("lenis", lenis);
}

function initMarquee() {
    const containers = gsap.utils.toArray(".no-marquee__item");

    if (containers.length === 0) return;

    containers.forEach((item) => {
        gsap.to(item, {
            xPercent: -100,
            repeat: -1,
            duration: 10,
            ease: "linear",
        }).totalProgress(0.5);
    });
}

class App {
    static global;

    static initGlobalFunc() {
        App.global = new Global();

        App.global.addEvent("lenis", initLenis);
        App.global.addEvent("swiper", initSwiper);
        App.global.addEvent("header", initHeader);
        App.global.addEvent("localNav", initLocalNav);
        App.global.addEvent("auth", initAuth);
        App.global.addEvent("tab", initTabs);
        App.global.addEvent("goToTop", initGoToTop);
        App.global.addEvent("faq", initFaqItems);

        App.global.addEvent("aos", AOS.init);
        App.global.listen();
    }

    static init() {
        window.addEventListener("DOMContentLoaded", () => {
            this.initGlobalFunc();
        });
    }
}

App.init();
