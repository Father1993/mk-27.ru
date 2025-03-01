document.addEventListener('DOMContentLoaded', function () {
    const calculatorForm = document.querySelector('.calculator-form')
    if (!calculatorForm) return

    const deliveryRates = {
        Хабаровск: {
            'В черте города': {
                base: 0,
                type: 'fixed',
            },
            Пригород: {
                base: 1000,
                type: 'fixed',
            },
            Владивосток: {
                base: 1000,
                perKg: 8,
                threshold: 100,
                type: 'weight',
            },
            Благовещенск: {
                base: 2300,
                perKg: 15,
                threshold: 100,
                type: 'weight',
            },
            Свободный: {
                base: 2500,
                perKg: 20,
                threshold: 100,
                type: 'weight',
            },
        },
        Владивосток: {
            'В черте города': {
                base: 1000,
                type: 'fixed',
            },
            Угольная: {
                base: 2000,
                type: 'fixed',
            },
            Артем: {
                base: 3000,
                type: 'fixed',
            },
            Уссурийск: {
                base: 8000,
                type: 'fixed',
            },
            Находка: {
                base: 12000,
                type: 'fixed',
            },
        },
        'Южно-Сахалинск': {
            'В черте города': {
                base: 1500,
                type: 'fixed',
            },
            Анива: {
                base: 4000,
                type: 'fixed',
            },
            Корсаков: {
                base: 7000,
                type: 'fixed',
            },
            Холмск: {
                base: 7000,
                type: 'fixed',
            },
        },
    }

    calculatorForm.addEventListener('submit', function (e) {
        e.preventDefault()

        const city = document.getElementById('delivery-city').value
        const weight =
            parseFloat(document.getElementById('delivery-weight').value) || 0
        const destination = document.getElementById(
            'delivery-destination'
        ).value

        const result = calculateDelivery(city, destination, weight)
        showResult(result, city, destination)
    })

    function calculateDelivery(city, destination, weight) {
        if (!deliveryRates[city] || !deliveryRates[city][destination]) {
            return {
                success: false,
                message:
                    'Для данного направления необходимо уточнить стоимость у менеджера',
            }
        }

        const rate = deliveryRates[city][destination]
        let cost = 0

        if (rate.type === 'fixed') {
            cost = rate.base
        } else if (rate.type === 'weight') {
            if (weight <= rate.threshold) {
                cost = rate.base
            } else {
                cost = rate.base + (weight - rate.threshold) * rate.perKg
            }
        }

        return {
            success: true,
            cost: cost,
            isEstimate: true,
        }
    }

    function showResult(result, city, destination) {
        const resultBlock = document.querySelector('.calculator-result')

        if (result.success) {
            resultBlock.innerHTML = `
                <div class="result-content">
                    <p class="result-price">Примерная стоимость доставки: ${result.cost.toLocaleString()} ₽</p>
                    <p class="result-note">Точную стоимость уточняйте у менеджера</p>
                    <a href="tel:+74212919043" class="result-phone">+7 (4212) 91-90-43, доб. 117</a>
                </div>
            `
        } else {
            resultBlock.innerHTML = `
                <div class="result-content">
                    <p class="result-note">${result.message}</p>
                    <a href="tel:+74212919043" class="result-phone">+7 (4212) 91-90-43, доб. 117</a>
                </div>
            `
        }

        resultBlock.style.display = 'block'
    }

    // Заполняем список городов
    const citySelect = document.getElementById('delivery-city')
    Object.keys(deliveryRates).forEach((city) => {
        const option = new Option(city, city)
        citySelect.add(option)
    })

    // Обновляем список направлений при выборе города
    citySelect.addEventListener('change', function () {
        const destinationSelect = document.getElementById(
            'delivery-destination'
        )
        destinationSelect.innerHTML =
            '<option value="">Выберите направление</option>'

        if (this.value && deliveryRates[this.value]) {
            Object.keys(deliveryRates[this.value]).forEach((destination) => {
                const option = new Option(destination, destination)
                destinationSelect.add(option)
            })
        }
    })
})
