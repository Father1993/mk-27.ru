<?php
$startYear = 2007;               // Год начала работы
$currentYear = date('Y');        // Текущий год
$yearsExperience = $currentYear - $startYear;  // Вычисляем разницу
?>

<div class="about-company">
  <div class="container-fluid p-0">
    <!-- Основной блок о компании -->
    <div class="row mb-5">
      <div class="col-lg-8">
        <div class="company-intro">
          <p class="company-description">
            <strong>Компания «Метиз Комплект»</strong> работает в сфере продаж строительного оборудования и материалов с
            2007 года. Наша специализация — это комплексная поставка грузоподъемного оборудования, инженерных систем,
            строительного оборудования, крепежей, электрического и ручного инструмента, комплектующих для опалубки,
            металлических сеток.
          </p>
          <p class="company-description">
            Ассортимент компании — это продукция крупных заводов отрасли в России, Беларуси и Юго-Восточной Азии.
            Расширение товарной линейки новинками в отрасли - одно из наших преимуществ, благодаря дилерским и
            дистрибьюторским контрактам.
          </p>
          <ul class="features-list">
            <li>Грузоподъемное оборудование</li>
            <li>Геотекстиль</li>
            <li>Инженерные системы</li>
            <li>Крепежные изделия</li>
            <li>Инструменты</li>
            <li>Строительные леса, вышки тура</li>
            <li>Опалубка, фиксаторы арматуры</li>
            <li>Проволока, СББ, ПББ</li>
            <li>Такелаж</li>
            <li>Станки для гибки и резки арматуры</li>
            <li>Сварочное оборудование</li>
            <li>Сетка: рабица, кладочная, цпвс, сварная, тканая, садовая</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="company-stats">
          <div class="stat-item">
            <span class="stat-number"><?= $yearsExperience ?>+</span>
            <span class="stat-text">лет на рынке</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">35000+</span>
            <span class="stat-text">товаров в ассортименте</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">30000+</span>
            <span class="stat-text">довольных клиентов</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Производство -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="production-block">
          <h3 class="section-subtitle">Собственное производство</h3>
          <div class="production-description">
            <p>В 2010 году состоялся запуск собственного производства сетки-Рабицы в г. Хабаровске. Восемь станков
              автоматического типа позволяют выпускать сетку-Рабицу в разных конфигурациях. Мощность собственного
              производства - 100 рулонов в сутки, что позволяет обеспечивать имеющиеся потребности рынка и выполнять
              индивидуальные заказы клиентов.</p>
          </div>
          <div class="production-features">
            <div class="production-card">
              <div class="card-content">
                <div class="feature-icon">
                  <i class="fas fa-industry"></i>
                </div>
                <h4>Сетка-Рабица</h4>
                <div class="production-stats">
                  <div class="stat">
                    <span class="stat-value">8</span>
                    <span class="stat-label">автоматических станков</span>
                  </div>
                  <div class="stat">
                    <span class="stat-value">100</span>
                    <span class="stat-label">рулонов в сутки</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="production-card">
              <div class="card-content">
                <div class="feature-icon">
                  <i class="fas fa-tools"></i>
                </div>
                <h4>Производственный цех</h4>
                <ul class="production-list">
                  <li>Фундаментные болты</li>
                  <li>Закладные детали</li>
                  <li>Анкерные группы</li>
                  <li>Металлические изделия по чертежам</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Торговые марки -->
    <div class="brands-section">
      <h3 class="section-subtitle">Собственные торговые марки</h3>
      <p class="brands-intro">С 2017 года компания «Метиз Комплект» сотрудничает с заводами и фабриками Юго-Восточной
        Азии по выпуску товаров под собственными торговыми марками. Это позволяет полностью контролировать и
        гарантировать качество поступающих товаров.</p>
      <div class="row brands-grid">
        <div class="col-md-6 col-lg-3">
          <div class="brand-card">
            <img src="/upload/iblock/453/22vi7a8o10pphbppnamsfr96b34xubb6.jpg" alt="FORCE LIFTING" class="brand-logo">
            <h4>FORCE LIFTING</h4>
            <p>Грузоподъемное оборудование</p>
            <ul class="brand-products">
              <li>Блоки монтажные, полиспасты</li>
              <li>Тали ручные, цепные</li>
              <li>Лебёдки ручные, крюки</li>
              <li>Домкраты, ремни стяжные</li>
              <li>Тележки гидравлические</li>
              <li>Тальферы, цепи</li>
              <li>Талрепы, коуши</li>
              <li>Троса, зажимы</li>
              <li>Карабины</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="brand-card">
            <img src="/upload/medialibrary/8a3/sz0f1iu3rx14qq8o21cx3emawyeogf8q.jpg" alt="AQUA LIFE" class="brand-logo">
            <h4>AQUA LIFE</h4>
            <p>Инженерные системы</p>
            <ul class="brand-products">
              <li>Фитинги стальные и чугунные</li>
              <li>Краны шаровые</li>
              <li>Фланцы всех типов</li>
              <li>Затворы, задвижки, вентили</li>
              <li>Трубы и фитинги ПП</li>
              <li>Детали трубопровода</li>
              <li>Компенсаторы</li>
              <li>Насосы</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="brand-card">
            <img src="/upload/medialibrary/a47/gkh6tosp2ta2b7idmlxqd2aptgqlodcq.jpg" alt="LASTING TOOLS"
              class="brand-logo">
            <h4>LASTING TOOLS</h4>
            <p>Инструменты и оборудование</p>
            <ul class="brand-products">
              <li>Пистолеты для герметика</li>
              <li>Пневмоинструмент</li>
              <li>Станки для арматуры</li>
              <li>Тачки строительные</li>
              <li>Тепловые пушки</li>
              <li>Сварочное оборудование</li>
              <li>Строительный инструмент</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="brand-card">
            <img src="/upload/iblock/cfa/q0ze392el8dpr3frkc0mlrf0j9e34knm.jpg" alt="POWER FASTEN" class="brand-logo">
            <h4>POWER FASTEN</h4>
            <p>Крепежные изделия</p>
            <ul class="brand-products">
              <li>Анкера и болты</li>
              <li>Высокопрочный крепеж</li>
              <li>Нагели и винты</li>
              <li>Гайки и дюбели</li>
              <li>Заклепки всех видов</li>
              <li>Саморезы</li>
              <li>Шайбы и шпильки</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Логистика и склады -->
    <div class="logistics-section">
      <h3 class="section-subtitle">Логистика и склады</h3>
      <div class="logistics-content">
        <p>Компания «Метиз Комплект» осуществляет доставку товаров на всей территории Дальнего Востока и в центральную
          часть страны. За <?= $yearsExperience ?> лет работы создан собственный автопарк транспорта грузоподъёмностью
          от 3 до 25 тонн.</p>
        <div class="logistics-features">
          <div class="feature-item">
            <div class="feature-icon">
              <img src="/local/templates/mk-27-new/include/about/part-logo/asortiment.png" alt="Ассортимент"
                class="icon-image">
            </div>
            <h4>Складские площади</h4>
            <p>От 10 000 до 20 000 м² в каждом городе присутствия</p>
          </div>
          <div class="feature-item">
            <div class="feature-icon">
              <img src="/local/templates/mk-27-new/include/about/part-logo/delivery.png" alt="Доставка"
                class="icon-image">
            </div>
            <h4>Транспортные партнеры</h4>
            <p>ООО «ТЭК ДВТК ФРАХТ»</p>
            <p>ООО «ТРАНСЭКСПЕДИЦИЯ-М»</p>
            <p>ООО «ТРАНЗИТ 27»</p>
          </div>
          <div class="feature-item">
            <div class="feature-icon">
              <img src="/local/templates/mk-27-new/include/about/part-logo/stores.png" alt="Склады" class="icon-image">
            </div>
            <h4>Ассортимент</h4>
            <p>Свыше 35 000 позиций в постоянном наличии</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Клиенты -->
    <div class="clients-section">
      <h3 class="section-subtitle">Наши клиенты</h3>
      <p class="clients-intro">Компания «Метиз Комплект» является поставщиком строительных материалов и оборудования для
        государственных и федеральных учреждений социального назначения, а также для коммерческих объектов.</p>
      <div class="major-clients">
        <div class="client-grid">
          <div class="client-item">
            <div class="client-logo">
              <img src="/local/templates/mk-27-new/include/about/part-logo/РусГидро.png" alt="РусГидро">
            </div>
            <div class="client-info">
              <h5>ПАО «РусГидро»</h5>
              <p>Энергетический холдинг</p>
            </div>
          </div>
          <div class="client-item">
            <div class="client-logo">
              <img src="/local/templates/mk-27-new/include/about/part-logo/gasprom.png" alt="Газпром">
            </div>
            <div class="client-info">
              <h5>ПАО «Газпром»</h5>
              <p>Транснациональная энергетическая компания</p>
            </div>
          </div>
          <div class="client-item">
            <div class="client-logo">
              <img src="/local/templates/mk-27-new/include/about/part-logo/vel.jpg" alt="Велесстрой">
            </div>
            <div class="client-info">
              <h5>ООО «Велесстрой»</h5>
              <p>Нефтегазовое и промышленное строительство</p>
            </div>
          </div>
          <div class="client-item">
            <div class="client-logo">
              <img src="/local/templates/mk-27-new/include/about/part-logo/nipgas.png" alt="НИПИГАЗ">
            </div>
            <div class="client-info">
              <h5>АО «НИПИГАЗ»</h5>
              <p>Инжиниринговый центр</p>
            </div>
          </div>
          <div class="client-item">
            <div class="client-logo">
              <img src="/local/templates/mk-27-new/include/about/part-logo/dgk.jpg" alt="ДГК">
            </div>
            <div class="client-info">
              <h5>АО «ДГК»</h5>
              <p>Дальневосточная генерирующая компания</p>
            </div>
          </div>
        </div>
      </div>
      <div class="international-clients">
        <h4>Международное сотрудничество</h4>
        <p>Успешный опыт работы с компаниями из Китая, Турции, Казахстана, Венгрии, Италии и Германии</p>
      </div>
    </div>
  </div>
</div>