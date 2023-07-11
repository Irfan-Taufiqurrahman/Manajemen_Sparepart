<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
<script src="{{ asset('js/init-alpine.js') }}"></script>
<script src="{{ asset('js/focus-trap.js') }}"></script>
<script src="{{ asset('js/charts-bars.js') }}" defer></script>
<script src="{{ asset('js/charts-lines.js') }}" defer></script>
<script src="{{ asset('js/charts-pie.js') }}" defer></script>
<script>
    // Alpine.js initialization
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebar', () => ({
            isSideMenuOpen: false,
            toggleSideMenu() {
                this.isSideMenuOpen = !this.isSideMenuOpen;
            },
            closeSideMenu() {
                this.isSideMenuOpen = false;
            }
        }));
        Alpine.data('modal', () => ({
            isModalOpen: false,
            openModal() {
                this.isModalOpen = true;
            },
            closeModal() {
                this.isModalOpen = false;
            }
        }));
    });
</script>
<!-- Add jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add DataTables.js -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script>
    // Initialize the card slider
    const cardSlider = document.querySelector('.card-slider');
    const cards = document.querySelectorAll('.card');

    // Calculate the width of a single card
    const cardWidth = cards[0].offsetWidth;

    // Set the width of the card slider based on the number of cards
    cardSlider.style.width = `${cardWidth * cards.length}px`;

    // Enable scrolling functionality for the card slider
    cardSlider.addEventListener('scroll', () => {
        const scrollPosition = cardSlider.scrollLeft;
        const maxScroll = cardSlider.scrollWidth - cardSlider.clientWidth;

        // Add CSS class to hide or show the scrollbar based on the scroll position
        if (scrollPosition === 0) {
            cardSlider.classList.remove('scrolling');
        } else if (scrollPosition === maxScroll) {
            cardSlider.classList.remove('scrolling');
        } else {
            cardSlider.classList.add('scrolling');
        }
    });
</script>


<style>
    .modal-open {
        overflow: hidden;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 9999;
    }
</style>