$(function(){

    const overlay = $('.js-admin-modal__overlay');
    const modal = $('.js-admin-modal');
    const modalBody = $('.js-admin-modal__inner');
    const modalOpenBtn = $('.js-admin__btn--detail');
    const modalCloseBtn = $('.js-admin-modal__close-btn');

    let controller = null;

    const cache = new Map(); // key: url, value: html

    modalOpenBtn.on('click', function(){
        const url = $(this).data('url');

        getDetail(url);

        overlay.addClass('is-open');
        modal.addClass('is-open');
    });

    modalCloseBtn.on('click', function(){
        overlay.removeClass('is-open');
        modal.removeClass('is-open');

        // 通信中なら中断
        if (controller) {
            controller.abort();
            controller = null;
        }
    });

    overlay.on('click', function(){
        overlay.removeClass('is-open');
        modal.removeClass('is-open');

        // 通信中なら中断
        if (controller) {
            controller.abort();
            controller = null;
        }
    });

    async function getDetail(url) {
        // 直前の通信を中断（連打/別行クリック対策）
        if (controller) controller.abort();
        controller = new AbortController();

        // キャッシュがあれば即表示（必要に応じて無効化）
        if (cache.has(url)) {
            modalBody.innerHTML = cache.get(url);
            return;
        }

        modalBody.innerHTML = '<div class="modal__loading">Loading...</div>';

        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            signal: controller.signal
        });

        if (!res.ok) {
            // 403/404/500などを適切に表示
            modalBody.innerHTML = `<div class="modal__error">取得に失敗しました（${res.status}）</div>`;
            return;
        }

        const data = await res.json();
        if (data.success) {
            cache.set(url, data.html);
            modalBody.append(data.html);
        }
    }
});
