<script>
    document.addEventListener('DOMContentLoaded', function() {
        var collapseElements = document.querySelectorAll('.collapse');

        collapseElements.forEach(function(collapse) {
            new bootstrap.Collapse(collapse, {
                toggle: false
            });

            collapse.addEventListener('show.bs.collapse', function() {
                const parent = collapse.closest('.has-submenu');
                if (!parent) return; // 🔒 proteção total

                parent.classList.add('show');

                const icon = collapse.previousElementSibling?.querySelector('i.ms-auto');
                if (icon) icon.style.transform = 'rotate(180deg)';

                collapseElements.forEach(function(otherCollapse) {
                    if (otherCollapse !== collapse && otherCollapse.classList.contains(
                            'show')) {
                        otherCollapse.classList.remove('show');

                        const otherIcon = otherCollapse.previousElementSibling
                            ?.querySelector('i.ms-auto');
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });
            });

            collapse.addEventListener('hide.bs.collapse', function() {
                const parent = collapse.closest('.has-submenu');
                if (!parent) return;

                parent.classList.remove('show');

                const icon = collapse.previousElementSibling?.querySelector('i.ms-auto');
                if (icon) icon.style.transform = 'rotate(0deg)';
            });
        });
    });
</script>
