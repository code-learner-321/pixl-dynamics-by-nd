jQuery(document).ready(function($) {
    const init = () => {
        initPagination();
        initFlipCards();
    };

    // Initialize and re-initialize when Elementor frontend is ready
    init();
    window.elementorFrontend?.hooks.addAction(
        'frontend/element_ready/elementor-gallery-flip-card.default',
        init
    );

    // function initFlipCards() {
    //     $('.card').off('mouseenter mouseleave').hover(
    //         e => $(e.currentTarget).toggleClass('flipped')
    //     );
    // }

    function loadPage(page, $container) {
        const $galleryContainer = $container.find('.gallery-container');
        const postsPerPage = $container.data('posts-per-page') || 2;
        const orderType = $container.data('order-type') || 'DESC';
        
        $container.addClass('loading');
        
        $.ajax({
            url: portfolioCardAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_cards',
                nonce: portfolioCardAjax.nonce,
                page,
                posts_per_page: postsPerPage,
                order_type: orderType
            },
            success: response => {
                if (!response.success) {
                    console.error('Failed to load cards:', response.data);
                    return;
                }

                $galleryContainer.find('.gallery').replaceWith(response.data.html);
                updatePagination($container, page, response.data.max_pages);
                setTimeout(init, 100);
            },
            error: (_, __, error) => console.error('Failed to load cards:', error),
            complete: () => $container.removeClass('loading')
        });
    }

    function updatePagination($container, currentPage, maxPages) {
        const $pagination = $container.find('.pagination-links');
        
        // Store the current page numbers HTML
        const pageNumbersHtml = [];
        for (let i = 1; i <= maxPages; i++) {
            const activeClass = i === currentPage ? ' current' : '';
            pageNumbersHtml.push(`<a href="#" data-page="${i}" class="page-number${activeClass}">${i}</a>`);
        }
        
        // Rebuild the pagination HTML
        let paginationHtml = '';
        // Add previous button if not on first page
        if (currentPage > 1) {
            paginationHtml += `<a href="#" data-page="${currentPage - 1}" class="page-number prev">&laquo; Previous</a>`;
        }
        
        // Add page numbers
        paginationHtml += pageNumbersHtml.join('');
        // Add next button if not on last page
        if (currentPage < maxPages) {
            paginationHtml += `<a href="#" data-page="${currentPage + 1}" class="page-number next">Next &raquo;</a>`;
        }
        
        // Update the pagination container
        $pagination.html(paginationHtml);
    }

    function initPagination() {
        $('.elementor-gallery-flip-card-container .pagination-links')
            .off('click')
            .on('click', '.page-number', e => {
                e.preventDefault();
                const $this = $(e.currentTarget);
                loadPage($this.data('page'), $this.closest('.elementor-gallery-flip-card-container'));
            });
    }

    window.onpopstate = () => location.reload();
});