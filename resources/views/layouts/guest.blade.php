<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'João Matos - Início') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>
</head>

<body>
    {{ $slot }}
    <!-- <div class="loader">
        <div class="blob"></div>
    </div> -->
</body>

<script>
    window.onload = () => {
        //document.body.scrollTop = document.documentElement.scrollTop = 0;
        //const loader = document.querySelector(".loader");
        //loader.className += " hidden";  
    };

    window.addEventListener("scroll", () => {
        handleScrollAnimation();
    });

    const scrollToTopBtn = document.getElementById("scrollToTop");
    const scrollElements = document.querySelectorAll(".js-scroll");
    const scrollElementsLang = document.querySelectorAll(".js-scroll-lang");

    const elementInView = (el, dividend = 1) => {
        const elementTop = el.getBoundingClientRect().top;
        return (
            elementTop <=
            (window.innerHeight || document.documentElement.clientHeight) / dividend
        );
    };

    const elementOutofView = (el) => {
        const elementTop = el.getBoundingClientRect().top;
        return (
            elementTop > (window.innerHeight || document.documentElement.clientHeight)
        );
    };

    const displayScrollElement = (element) => {
        element.classList.add("scrolled");
    };

    const hideScrollElement = (element) => {
        element.classList.remove("scrolled");
    };

    const handleScrollAnimation = () => {
        scrollElements.forEach((el) => {
            if (elementInView(el, 1)) {
                displayScrollElement(el);
            } else if (elementOutofView(el)) {
                //Re-animate
                hideScrollElement(el)
            }
        })

        scrollElementsLang.forEach((el) => {
            if (elementInView(el, 1)) {
                el.classList.add("spoken-main");
                displayScrollElement(el);
            } else if (elementOutofView(el)) {
                //Re-animate
                el.classList.remove("spoken-main");
                hideScrollElement(el)
            }
        })

        if (document.body.scrollTop > 180 || document.documentElement.scrollTop > 180) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }

    function scrollToTop() {
        document.documentElement.scrollTo({
            top: 0,
            behavior: "smooth"
        })
    }

    function onSubmitContact(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ config('services.recaptcha.key') }}", {action: 'submit'}).then(function(token) {
                document.getElementById("g-recaptcha-response").value = token;
                document.getElementById("contact-form").submit();
            });
        });
    }
</script>

</html>