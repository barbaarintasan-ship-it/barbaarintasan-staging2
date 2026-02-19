document.addEventListener('DOMContentLoaded', function() {
    var header = document.getElementById('bsa-header');
    var mobileToggle = document.getElementById('bsa-mobile-toggle');
    var mobileNav = document.getElementById('bsa-mobile-nav');
    var mobileClose = document.getElementById('bsa-mobile-close');

    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function() {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

    function closeMobileNav() {
        if (mobileNav) {
            mobileNav.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileNav);
    }

    if (mobileNav) {
        mobileNav.addEventListener('click', function(e) {
            if (e.target === mobileNav) {
                closeMobileNav();
            }
        });
    }

    var fadeEls = document.querySelectorAll('.bsa-fade-up');
    if (fadeEls.length > 0 && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        fadeEls.forEach(function(el) {
            observer.observe(el);
        });
    } else {
        fadeEls.forEach(function(el) {
            el.classList.add('visible');
        });
    }

    var gallery = document.getElementById('bsa-gallery');
    if (gallery && gallery.children.length > 0) {
        var clone = gallery.innerHTML;
        gallery.innerHTML = clone + clone;
    }
});
