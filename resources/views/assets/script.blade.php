<!-- DataTables.net CSS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables.net JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive: true // Enable responsive behavior
        });
    });
</script>


<script src="https://unpkg.com/@popperjs/core@2"></script>

<!-- plugin for charts  -->
<script src="{{ asset('js/plugins/chartjs.min.js') }}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}" async></script>
<!-- main script file  -->
<!--<script src="{{ asset('js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>-->


<!-- argon-dashboard-tailwind.js -->
<script>
    /*!

=========================================================
* Argon Dashboard Tailwind - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
    var page = window.location.pathname.split("/").pop().split(".")[0];
    var aux = window.location.pathname.split("/");
    var to_build = (aux.includes('pages') || aux.includes('docs') ? '../' : './');
    var root = window.location.pathname.split("/")
    if (!aux.includes("pages")) {
        page = "dashboard";
    }

    loadStylesheet(to_build + "assets/css/perfect-scrollbar.css");
    loadJS(to_build + "assets/js/perfect-scrollbar.js", true);

    if (document.querySelector("[slider]")) {
        loadJS(to_build + "assets/js/carousel.js", true);
    }

    if (document.querySelector("nav [navbar-trigger]")) {
        loadJS(to_build + "assets/js/navbar-collapse.js", true);
    }

    if (document.querySelector("[data-target='tooltip']")) {
        loadJS(to_build + "assets/js/tooltips.js", true);
        loadStylesheet(to_build + "assets/css/tooltips.css");
    }

    if (document.querySelector("[nav-pills]")) {
        loadJS(to_build + "assets/js/nav-pills.js", true);
    }

    if (document.querySelector("[dropdown-trigger]")) {
        loadJS(to_build + "assets/js/dropdown.js", true);

    }

    if (document.querySelector("[fixed-plugin]")) {
        loadJS(to_build + "assets/js/fixed-plugin.js", true);
    }

    if (document.querySelector("[navbar-main]") || document.querySelector("[navbar-profile]")) {
        if (document.querySelector("[navbar-main]")) {
            loadJS(to_build + "assets/js/navbar-sticky.js", true);
        }
        if (document.querySelector("aside")) {
            loadJS(to_build + "assets/js/sidenav-burger.js", true);
        }
    }

    if (document.querySelector("canvas")) {
        loadJS(to_build + "assets/js/charts.js", true);
    }

    if (document.querySelector(".github-button")) {
        loadJS("https://buttons.github.io/buttons.js", true);
    }

    function loadJS(FILE_URL, async) {
        let dynamicScript = document.createElement("script");

        dynamicScript.setAttribute("src", FILE_URL);
        dynamicScript.setAttribute("type", "text/javascript");
        dynamicScript.setAttribute("async", async);

        document.head.appendChild(dynamicScript);
    }

    function loadStylesheet(FILE_URL) {
        let dynamicStylesheet = document.createElement("link");

        dynamicStylesheet.setAttribute("href", FILE_URL);
        dynamicStylesheet.setAttribute("type", "text/css");
        dynamicStylesheet.setAttribute("rel", "stylesheet");

        document.head.appendChild(dynamicStylesheet);
    }
</script>

<script>
    var page = window.location.pathname.split("/").pop().split(".")[0],
        aux = window.location.pathname.split("/"),
        to_build = aux.includes("pages") || aux.includes("docs") ? "../" : "./",
        root = window.location.pathname.split("/");

    function loadJS(b, c) {
        let a = document.createElement("script");
        a.setAttribute("src", b), a.setAttribute("type", "text/javascript"), a.setAttribute("async", c), document.head.appendChild(a)
    }

    function loadStylesheet(b) {
        let a = document.createElement("link");
        a.setAttribute("href", b), a.setAttribute("type", "text/css"), a.setAttribute("rel", "stylesheet"), document.head.appendChild(a)
    }
    aux.includes("pages") || (page = "dashboard"), loadStylesheet(to_build + "assets/css/perfect-scrollbar.css"), loadJS(to_build + "assets/js/perfect-scrollbar.js", !0), document.querySelector("[slider]") && loadJS(to_build + "assets/js/carousel.js", !0), document.querySelector("nav [navbar-trigger]") && loadJS(to_build + "assets/js/navbar-collapse.js", !0), document.querySelector("[data-target='tooltip']") && (loadJS(to_build + "assets/js/tooltips.js", !0), loadStylesheet(to_build + "assets/css/tooltips.css")), document.querySelector("[nav-pills]") && loadJS(to_build + "assets/js/nav-pills.js", !0), document.querySelector("[dropdown-trigger]") && loadJS(to_build + "assets/js/dropdown.js", !0), document.querySelector("[fixed-plugin]") && loadJS(to_build + "assets/js/fixed-plugin.js", !0), (document.querySelector("[navbar-main]") || document.querySelector("[navbar-profile]")) && (document.querySelector("[navbar-main]") && loadJS(to_build + "assets/js/navbar-sticky.js", !0), document.querySelector("aside") && loadJS(to_build + "assets/js/sidenav-burger.js", !0)), document.querySelector("canvas") && loadJS(to_build + "assets/js/charts.js", !0), document.querySelector(".github-button") && loadJS("https://buttons.github.io/buttons.js", !0)
</script>

<script>
    (function() {
        var isWindows = navigator.platform.indexOf("Win") > -1 ? true : false;

        if (isWindows) {
            // if we are on windows OS we activate the perfectScrollbar function
            if (document.querySelector("main")) {
                var mainpanel = document.querySelector("main");
                var ps = new PerfectScrollbar(mainpanel);
            }

            if (document.querySelectorAll(".overflow-auto")[0]) {
                var sidebar = document.querySelectorAll(".overflow-auto");
                var i = 0;
                var ps;
                sidebar.forEach((element) => {
                    ps[i++] = new PerfectScrollbar(element);
                });
            }
            if (document.querySelectorAll(".overflow-y-auto")[0]) {
                var sidebar = document.querySelectorAll(".overflow-y-auto");
                var i = 0;
                var ps;
                sidebar.forEach((element) => {
                    ps[i++] = new PerfectScrollbar(element);
                });
            }
            if (document.querySelectorAll(".overflow-x-auto")[0]) {
                var sidebar = document.querySelectorAll(".overflow-x-auto");
                var i = 0;
                var ps;
                sidebar.forEach((element) => {
                    ps[i++] = new PerfectScrollbar(element);
                });
            }
        }
    });
</script>

<script>
    // Navbar stick on scroll ++ styles

    var navbar = document.querySelector("[navbar-main]");
    const white_elements = navbar.querySelectorAll(".text-white");
    const white_bg_elements = navbar.querySelectorAll("[sidenav-trigger] i.bg-white");
    const white_before_elements = navbar.querySelectorAll(".before\\:text-white");


    window.onscroll = function() {
        let blur = navbar.getAttribute("navbar-scroll");
        if (blur == "true") stickyNav();
    };

    function stickyNav() {
        if (window.scrollY >= 5) {
            navbar.classList.add("sticky", "top-[1%]", "backdrop-saturate-200", "dark:bg-slate-850/80", "dark:shadow-dark-blur", "backdrop-blur-2xl", "bg-[hsla(0,0%,100%,0.8)]", "shadow-blur", "z-110");
            white_elements.forEach(element => {
                element.classList.remove("text-white")
                element.classList.add("dark:text-white")
            });
            white_bg_elements.forEach(element => {
                element.classList.remove("bg-white")
                element.classList.add("dark:bg-white")
                element.classList.add("bg-slate-500")
            });
            white_before_elements.forEach(element => {
                element.classList.add("dark:before:text-white")
                element.classList.remove("before:text-white")
            });
        } else {
            navbar.classList.remove("sticky", "top-[1%]", "backdrop-saturate-200", "dark:bg-slate-850/80", "dark:shadow-dark-blur", "backdrop-blur-2xl", "bg-[hsla(0,0%,100%,0.8)]", "shadow-blur", "z-110");
            white_elements.forEach(element => {
                element.classList.add("text-white")
                element.classList.remove("dark:text-white")
            });
            white_bg_elements.forEach(element => {
                element.classList.add("bg-white")
                element.classList.remove("dark:bg-white")
                element.classList.remove("bg-slate-500")
            });
            white_before_elements.forEach(element => {
                element.classList.remove("dark:before:text-white")
                element.classList.add("before:text-white")
            });
        }
    }
</script>



<!-- nav-pills.js -->
<script>
    // Tabs navigation

    var total = document.querySelectorAll("[nav-pills]");

    total.forEach(function(item, i) {
        var moving_div = document.createElement("div");
        var first_li = item.querySelector("li:first-child [nav-link]");
        var tab = first_li.cloneNode();
        tab.innerHTML = "-";
        tab.classList.remove("bg-inherit", "text-slate-700");
        tab.classList.add("bg-white", "text-white");
        tab.style.animation = ".2s ease";

        moving_div.classList.add("z-10", "absolute", "text-slate-700", "rounded-lg", "bg-inherit", "flex-auto", "text-center", "bg-none", "border-0", "block");
        moving_div.setAttribute("moving-tab", "");
        moving_div.setAttribute("nav-link", "");
        moving_div.appendChild(tab);
        item.appendChild(moving_div);

        var list_length = item.getElementsByTagName("li").length;

        moving_div.style.boxShadow = "0 1px 5px 1px #ddd";
        moving_div.style.padding = "0px";
        moving_div.style.width = item.querySelector("li:nth-child(1)").offsetWidth + "px";
        moving_div.style.transform = "translate3d(0px, 0px, 0px)";
        moving_div.style.transition = ".5s ease";

        item.onmouseover = function(event) {
            let target = getEventTarget(event);
            let li = target.closest("li");
            if (li) {
                let nodes = Array.from(li.closest("ul").children);
                let index = nodes.indexOf(li) + 1;
                item.querySelector("li:nth-child(" + index + ") [nav-link]").onclick = function() {
                    item.querySelectorAll("li").forEach(function(list_item) {
                        list_item.firstElementChild.removeAttribute("active");
                    });
                    li.firstElementChild.setAttribute("active", "");
                    moving_div = item.querySelector("[moving-tab]");
                    let sum = 0;
                    if (item.classList.contains("flex-col")) {
                        for (var j = 1; j <= nodes.indexOf(li); j++) {
                            sum += item.querySelector("li:nth-child(" + j + ")").offsetHeight;
                        }
                        moving_div.style.transform = "translate3d(0px," + sum + "px, 0px)";
                        moving_div.style.height = item.querySelector("li:nth-child(" + j + ")").offsetHeight;
                    } else {
                        for (var j = 1; j <= nodes.indexOf(li); j++) {
                            sum += item.querySelector("li:nth-child(" + j + ")").offsetWidth;
                        }
                        moving_div.style.transform = "translate3d(" + sum + "px, 0px, 0px)";
                        moving_div.style.width = item.querySelector("li:nth-child(" + index + ")").offsetWidth + "px";
                    }
                };
            }
        };
    });

    // Tabs navigation resize

    window.addEventListener("resize", function(event) {
        total.forEach(function(item, i) {
            item.querySelector("[moving-tab]").remove();
            var moving_div = document.createElement("div");
            var tab = item.querySelector("[nav-link][active]").cloneNode();
            tab.innerHTML = "-";
            tab.classList.remove("bg-inherit");
            tab.classList.add("bg-white", "text-white");
            tab.style.animation = ".2s ease";

            moving_div.classList.add("z-10", "absolute", "text-slate-700", "rounded-lg", "bg-inherit", "flex-auto", "text-center", "bg-none", "border-0", "block");
            moving_div.setAttribute("moving-tab", "");
            moving_div.setAttribute("nav-link", "");
            moving_div.appendChild(tab);

            item.appendChild(moving_div);

            moving_div.style.boxShadow = "0 1px 5px 1px #ddd";
            moving_div.style.padding = "0px";
            moving_div.style.transition = ".5s ease";

            let li = item.querySelector("[nav-link][active]").parentElement;

            if (li) {
                let nodes = Array.from(li.closest("ul").children);
                let index = nodes.indexOf(li) + 1;

                let sum = 0;
                if (item.classList.contains("flex-col")) {
                    for (var j = 1; j <= nodes.indexOf(li); j++) {
                        sum += item.querySelector("li:nth-child(" + j + ")").offsetHeight;
                    }
                    moving_div.style.transform = "translate3d(0px," + sum + "px, 0px)";
                    moving_div.style.width = item.querySelector("li:nth-child(" + index + ")").offsetWidth + "px";
                    moving_div.style.height = item.querySelector("li:nth-child(" + j + ")").offsetHeight;
                } else {
                    for (var j = 1; j <= nodes.indexOf(li); j++) {
                        sum += item.querySelector("li:nth-child(" + j + ")").offsetWidth;
                    }
                    moving_div.style.transform = "translate3d(" + sum + "px, 0px, 0px)";
                    moving_div.style.width = item.querySelector("li:nth-child(" + index + ")").offsetWidth + "px";
                }
            }
        });

        if (window.innerWidth < 991) {
            total.forEach(function(item, i) {
                if (!item.classList.contains("flex-col")) {
                    item.classList.add("flex-col", "on-resize");
                }
            });
        } else {
            total.forEach(function(item, i) {
                if (item.classList.contains("on-resize")) {
                    item.classList.remove("flex-col", "on-resize");
                }
            });
        }
    });

    function getEventTarget(e) {
        e = e || window.event;
        return e.target || e.srcElement;
    }
</script>

<!-- fixed-plugins.js -->
<script>
    var pageName = window.location.pathname.split("/").pop().split(".")[0];

    var fixedPlugin = document.querySelector("[fixed-plugin]");
    var fixedPluginButton = document.querySelector("[fixed-plugin-button]");
    var fixedPluginButtonNav = document.querySelector("[fixed-plugin-button-nav]");
    var fixedPluginCard = document.querySelector("[fixed-plugin-card]");
    var fixedPluginCloseButton = document.querySelector("[fixed-plugin-close-button]");

    var navbar = document.querySelector("[navbar-main]");

    var buttonNavbarFixed = document.querySelector("[navbarFixed]");

    var sidenav = document.querySelector("aside");
    var sidenav_icons = sidenav.querySelectorAll("li a div");

    var sidenav_target = "../pages/" + pageName + ".html";

    var whiteBtn = document.querySelector("[transparent-style-btn]");
    var darkBtn = document.querySelector("[white-style-btn]");

    var non_active_style = ["bg-none", "bg-transparent", "text-blue-500", "border-blue-500"];
    var active_style = ["bg-gradient-to-tl", "from-blue-500", "to-violet-500", "bg-blue-500", "text-white", "border-transparent"];

    var white_sidenav_classes = ["bg-white", "shadow-xl"];
    // var white_sidenav_highlighted = ["shadow-xl"];
    // var white_sidenav_icons = ["bg-white"];

    var black_sidenav_classes = ["bg-slate-850", "shadow-none"];
    // var black_sidenav_highlighted = ["shadow-none"];
    // var black_sidenav_icons = ["bg-gray-200"];

    var sidenav_highlight = document.querySelector("a[href=" + CSS.escape(sidenav_target) + "]");

    // fixed plugin toggle
    if (pageName != "rtl") {
        fixedPluginButton.addEventListener("click", function() {
            fixedPluginCard.classList.toggle("-right-90");
            fixedPluginCard.classList.toggle("right-0");
        });

        fixedPluginButtonNav.addEventListener("click", function() {
            fixedPluginCard.classList.toggle("-right-90");
            fixedPluginCard.classList.toggle("right-0");
        });

        fixedPluginCloseButton.addEventListener("click", function() {
            fixedPluginCard.classList.toggle("-right-90");
            fixedPluginCard.classList.toggle("right-0");
        });

        window.addEventListener("click", function(e) {
            if (!fixedPlugin.contains(e.target) && !fixedPluginButton.contains(e.target) && !fixedPluginButtonNav.contains(e.target)) {
                if (fixedPluginCard.classList.contains("right-0")) {
                    fixedPluginCloseButton.click();
                }
            }
        });
    } else {
        fixedPluginButton.addEventListener("click", function() {
            fixedPluginCard.classList.toggle("-left-90");
            fixedPluginCard.classList.toggle("left-0");
        });

        fixedPluginButtonNav.addEventListener("click", function() {
            fixedPluginCard.classList.toggle("-left-90");
            fixedPluginCard.classList.toggle("left-0");
        });

        fixedPluginCloseButton.addEventListener("click", function() {
            fixedPluginCard.classList.toggle("-left-90");
            fixedPluginCard.classList.toggle("left-0");
        });

        window.addEventListener("click", function(e) {
            if (!fixedPlugin.contains(e.target) && !fixedPluginButton.contains(e.target) && !fixedPluginButtonNav.contains(e.target)) {
                if (fixedPluginCard.classList.contains("left-0")) {
                    fixedPluginCloseButton.click();
                }
            }
        });
    }

    // color sidenav

    function sidebarColor(a) {
        var color = a.getAttribute("data-color");
        var parent = a.parentElement.children;
        var activeColor;

        var activeSidenavIconColorClass;

        var checkedSidenavIconColor = "bg-" + color + "-500/30";

        var sidenavIcon = document.querySelector("a[href=" + CSS.escape(sidenav_target) + "]");

        for (var i = 0; i < parent.length; i++) {
            if (parent[i].hasAttribute("active-color")) {
                activeColor = parent[i].getAttribute("data-color");

                parent[i].classList.toggle("border-white");
                parent[i].classList.toggle("border-slate-700");

                activeSidenavIconColorClass = "bg-" + activeColor + "-500/30";
            }
            parent[i].removeAttribute("active-color");
        }

        var att = document.createAttribute("active-color");

        a.setAttributeNode(att);
        a.classList.toggle("border-white");
        a.classList.toggle("border-slate-700");

        //   remove active style

        sidenavIcon.classList.remove(activeSidenavIconColorClass);

        //   add new style

        sidenavIcon.classList.add(checkedSidenavIconColor);
    }

    // sidenav style

    whiteBtn.addEventListener("click", function() {
        const active_style_attr = document.createAttribute("active-style");
        if (!this.hasAttribute(active_style_attr)) {
            // change trigger buttons style

            this.setAttributeNode(active_style_attr);

            non_active_style.forEach((style_class) => {
                this.classList.remove(style_class);
            });

            active_style.forEach((style_class) => {
                this.classList.add(style_class);
            });

            darkBtn.removeAttribute(active_style_attr);

            active_style.forEach((style_class) => {
                darkBtn.classList.remove(style_class);
            });

            non_active_style.forEach((style_class) => {
                darkBtn.classList.add(style_class);
            });

            // change actual styles

            black_sidenav_classes.forEach((style_class) => {
                sidenav.classList.remove(style_class);
            });
            white_sidenav_classes.forEach((style_class) => {
                sidenav.classList.add(style_class);
            });
            sidenav.classList.remove("dark");
        }
    });

    darkBtn.addEventListener("click", function() {
        const active_style_attr = document.createAttribute("active-style");
        if (!this.hasAttribute(active_style_attr)) {
            this.setAttributeNode(active_style_attr);
            non_active_style.forEach((style_class) => {
                this.classList.remove(style_class);
            });
            active_style.forEach((style_class) => {
                this.classList.add(style_class);
            });

            whiteBtn.removeAttribute(active_style_attr);
            active_style.forEach((style_class) => {
                whiteBtn.classList.remove(style_class);
            });
            non_active_style.forEach((style_class) => {
                whiteBtn.classList.add(style_class);
            });

            // change actual styles

            white_sidenav_classes.forEach((style_class) => {
                sidenav.classList.remove(style_class);
            });
            black_sidenav_classes.forEach((style_class) => {
                sidenav.classList.add(style_class);
            });
            sidenav.classList.add("dark");
        }
    });

    // navbar fixed plugin

    if (navbar) {
        if (navbar.getAttribute("navbar-scroll") == "true") {
            buttonNavbarFixed.setAttribute("checked", "true");
        }
        const white_elements = navbar.querySelectorAll(".text-white");
        const white_bg_elements = navbar.querySelectorAll("[sidenav-trigger] i.bg-white");
        const white_before_elements = navbar.querySelectorAll(".before\\:text-white");
        buttonNavbarFixed.addEventListener("change", function() {

            if (this.checked) {
                white_elements.forEach(element => {
                    element.classList.remove("text-white")
                    element.classList.add("dark:text-white")
                });
                white_bg_elements.forEach(element => {
                    element.classList.remove("bg-white")
                    element.classList.add("dark:bg-white")
                    element.classList.add("bg-slate-500")
                });
                white_before_elements.forEach(element => {
                    element.classList.add("dark:before:text-white")
                    element.classList.remove("before:text-white")
                });
                navbar.setAttribute("navbar-scroll", "true");
                navbar.classList.add("sticky");
                navbar.classList.add("top-[1%]");
                navbar.classList.add("backdrop-saturate-200");
                navbar.classList.add("backdrop-blur-2xl");
                navbar.classList.add("dark:bg-slate-850/80");
                navbar.classList.add("dark:shadow-dark-blur");
                navbar.classList.add("bg-[hsla(0,0%,100%,0.8)]");
                navbar.classList.add("shadow-blur");
                navbar.classList.add("z-110");
            } else {
                navbar.setAttribute("navbar-scroll", "false");
                navbar.classList.remove("sticky");
                navbar.classList.remove("top-[1%]");
                navbar.classList.remove("backdrop-saturate-200");
                navbar.classList.remove("backdrop-blur-2xl");
                navbar.classList.remove("dark:bg-slate-850/80");
                navbar.classList.remove("dark:shadow-dark-blur");
                navbar.classList.remove("bg-[hsla(0,0%,100%,0.8)]");
                navbar.classList.remove("shadow-blur");
                navbar.classList.remove("z-110");
                white_elements.forEach(element => {
                    element.classList.add("text-white")
                    element.classList.remove("dark:text-white")
                });
                white_bg_elements.forEach(element => {
                    element.classList.add("bg-white")
                    element.classList.remove("dark:bg-white")
                    element.classList.remove("bg-slate-500")
                });
                white_before_elements.forEach(element => {
                    element.classList.remove("dark:before:text-white")
                    element.classList.add("before:text-white")
                });
            }
        });
    } else {
        // buttonNavbarFixed.setAttribute("checked", "true");
        buttonNavbarFixed.setAttribute("disabled", "true");
    }

    var dark_mode_toggle = document.querySelector("[dark-toggle]");
    var root_html = document.querySelector("html");

    dark_mode_toggle.addEventListener("change", function() {
        dark_mode_toggle.setAttribute("manual", "true");
        if (this.checked) {
            root_html.classList.add("dark");
        } else {
            root_html.classList.remove("dark");
        }
    });
</script>

<!-- dropdown.js -->
<script>
    // Navbar notifications dropdown

    var dropdown_triggers = document.querySelectorAll("[dropdown-trigger]");
    dropdown_triggers.forEach((dropdown_trigger) => {
        let dropdown_menu = dropdown_trigger.parentElement.querySelector("[dropdown-menu]");

        dropdown_trigger.addEventListener("click", function() {
            dropdown_menu.classList.toggle("opacity-0");
            dropdown_menu.classList.toggle("pointer-events-none");
            dropdown_menu.classList.toggle("before:-top-5");
            if (dropdown_trigger.getAttribute("aria-expanded") == "false") {
                dropdown_trigger.setAttribute("aria-expanded", "true");
                dropdown_menu.classList.remove("transform-dropdown");
                dropdown_menu.classList.add("transform-dropdown-show");
            } else {
                dropdown_trigger.setAttribute("aria-expanded", "false");
                dropdown_menu.classList.remove("transform-dropdown-show");
                dropdown_menu.classList.add("transform-dropdown");
            }
        });

        window.addEventListener("click", function(e) {
            if (!dropdown_menu.contains(e.target) && !dropdown_trigger.contains(e.target)) {
                if (dropdown_trigger.getAttribute("aria-expanded") == "true") {
                    dropdown_trigger.click();
                }
            }
        });
    });
</script>

<!-- carousel.js  -->
<script>
    // "use strict";
    // Select all slides
    const slides = document.querySelectorAll("[slide]");

    // loop through slides and set each slides translateX
    slides.forEach((slide, indx) => {
        slide.style.transform = `translateX(${indx * 100}%)`;
    });

    // select next slide button
    const nextSlide = document.querySelector("[btn-next]");

    // current slide counter
    let curSlide = 0;
    // maximum number of slides
    let maxSlide = slides.length - 1;

    // add event listener and navigation functionality
    nextSlide.addEventListener("click", function() {
        // check if current slide is the last and reset current slide
        if (curSlide === maxSlide) {
            curSlide = 0;
        } else {
            curSlide++;
        }

        //   move slide by -100%
        slides.forEach((slide, indx) => {
            slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
        });
    });

    // select next slide button
    const prevSlide = document.querySelector("[btn-prev]");

    // add event listener and navigation functionality
    prevSlide.addEventListener("click", function() {
        // check if current slide is the first and reset current slide to last
        if (curSlide === 0) {
            curSlide = maxSlide;
        } else {
            curSlide--;
        }

        //   move slide by 100%
        slides.forEach((slide, indx) => {
            slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
        });
    });
</script>