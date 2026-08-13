document.addEventListener('DOMContentLoaded', function () {
    const likeForm = document.querySelector('.like-form');
    const likeIcon = document.querySelector('.like-icon');
    const likeCount = document.querySelector('.like-count');



    likeForm.addEventListener('submit', function (event) {
        event.preventDefault();

        fetch(likeForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })

        .then(response => {
    if (response.status === 401) {
        window.location.href = '/login';
        return;
    }

    if (response.redirected) {
        window.location.href = response.url;
        return;
    }

    return response.json();
})
        .then(data => {
            if (!data) {
            return;
        }

            likeIcon.src = data.isLiked
            ? '/images/ハートロゴ_ピンク.png'
            : '/images/ハートロゴ_デフォルト.png';

    likeCount.textContent = data.likeCount;
});
    });
});