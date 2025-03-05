function change_city(city) {
    $('.city-change').removeClass('active')
    $('.city-change-' + city).addClass('active')

    $('.contacts').removeClass('active')
    $('.contacts-' + city).addClass('active')

    // Плавное переключение блоков с режимом работы
    $('.holiday-block').removeClass('active')
    setTimeout(function () {
        $('.holiday-block-' + city).addClass('active')
    }, 50)

    // Плавная прокрутка к блоку с режимом работы, если он есть
    if ($('.holiday-block-' + city).length > 0) {
        setTimeout(function () {
            $('html, body').animate(
                {
                    scrollTop: $('.holiday-block-' + city).offset().top - 100,
                },
                500
            )
        }, 100)
    }
}

// Инициализация при загрузке страницы
$(document).ready(function () {
    // Добавляем анимацию при наведении на блок с режимом работы
    $('.holiday-schedule').hover(
        function () {
            $(this)
                .find('.holiday-schedule-inner')
                .css('transform', 'translateY(-5px)')
        },
        function () {
            $(this)
                .find('.holiday-schedule-inner')
                .css('transform', 'translateY(0)')
        }
    )

    // Добавляем анимацию при клике на заголовок блока с режимом работы
    $('.holiday-schedule-title').click(function () {
        $(this).next('.holiday-schedule-content').slideToggle(300)
        $(this).find('i').toggleClass('rotate-icon')
    })

    // Добавляем эффект пульсации для значка "Важно!"
    pulseBadge()

    // Добавляем анимацию для иконки в holiday-icon-wrapper
    animateHolidayIcon()
})

// Функция для пульсации значка "Важно!"
function pulseBadge() {
    $('.holiday-badge').animate(
        {
            opacity: 0.6,
        },
        700,
        function () {
            $(this).animate(
                {
                    opacity: 1,
                },
                700,
                function () {
                    pulseBadge()
                }
            )
        }
    )
}

// Функция для анимации иконки в holiday-icon-wrapper
function animateHolidayIcon() {
    $('.holiday-icon-wrapper i').animate(
        {
            fontSize: '45px',
        },
        1000,
        function () {
            $(this).animate(
                {
                    fontSize: '40px',
                },
                1000,
                function () {
                    animateHolidayIcon()
                }
            )
        }
    )
}
