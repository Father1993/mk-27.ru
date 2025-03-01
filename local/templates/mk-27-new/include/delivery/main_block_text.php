<div class="delivery-page">
  <!-- Преимущества доставки -->
  <section class="delivery-advantages">
    <div class="container">
      <div class="advantages-grid">
        <div class="advantage-item">
          <div class="advantage-icon">
            <i class="bi bi-truck"></i>
          </div>
          <h3>Собственный автопарк</h3>
          <p>Контроль качества на каждом этапе доставки</p>
        </div>
        <div class="advantage-item">
          <div class="advantage-icon">
            <i class="bi bi-shield-check"></i>
          </div>
          <h3>Надёжные партнёры</h3>
          <p>Сотрудничество с проверенными перевозчиками</p>
        </div>
        <div class="advantage-item">
          <div class="advantage-icon">
            <i class="bi bi-box-seam"></i>
          </div>
          <h3>Любые объёмы</h3>
          <p>От небольших заказов до крупных партий</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Основная информация -->
  <section class="delivery-info">
    <div class="container">
      <div class="info-grid">
        <div class="info-content">
          <h2>О нашей доставке</h2>
          <p>Компания «Метиз Комплект» осуществляет доставку Вашего груза во все регионы России. Мы пошли по пути
            объединения собственного автопарка машин и нескольких крупных перевозчиков. Это позволило нам обеспечивать
            перевозку любых объемов, при этом контролировать качество перевозок за счет работы исключительно с
            проверенными партнерами.</p>
          <div class="client-types">
            <div class="client-type">
              <i class="bi bi-person"></i>
              <span>Физические лица</span>
            </div>
            <div class="client-type">
              <i class="bi bi-building"></i>
              <span>Юридические лица</span>
            </div>
          </div>
        </div>
        <div class="info-image">
          <img src="/upload/medialibrary/8e3/xwibaiupmi5dn2jb289so3nrirbm8e0z.jpg" alt="Доставка Метиз Комплект">
        </div>
      </div>
    </div>
  </section>

  <!-- Тарифы -->
  <section class="delivery-rates">
    <div class="container">
      <h2>Тарифы на доставку</h2>
      <div class="rates-grid">
        <div class="rate-card">
          <img src="/upload/medialibrary/a84/f20o81n4gi6f6kpw7r4a97liquvzsf2p.jpg" alt="Тарифы на доставку">
        </div>
        <div class="rate-card">
          <img src="/upload/medialibrary/ce6/1wua0wsiqxehvrpc1fjzcsjpfkyv3eon.jpg" alt="Тарифы на доставку">
        </div>
      </div>
    </div>
  </section>

  <!-- Форма расчета -->
  <section class="delivery-calculator">
    <div class="container">
      <div class="calculator-wrapper">
        <h2>Рассчитать стоимость доставки</h2>
        <form class="calculator-form">
          <div class="form-group">
            <select id="delivery-city" required>
              <option value="">Выберите город отправления</option>
            </select>
          </div>
          <div class="form-group">
            <select id="delivery-destination" required>
              <option value="">Выберите направление</option>
            </select>
          </div>
          <div class="form-group">
            <input type="number" id="delivery-weight" placeholder="Вес груза (кг)" min="0" step="0.1" required>
          </div>
          <button type="submit" class="btn-calculate">
            <i class="bi bi-calculator"></i>
            Рассчитать
          </button>
        </form>
        <div class="calculator-result" style="display: none;"></div>
        <div class="delivery-note">
          <p>* Расчет является приблизительным. Точную стоимость доставки уточняйте у менеджера.</p>
          <p>* Доставка в г. Владивосток осуществляется еженедельно по вторникам и субботам.</p>
          <p>* Доставка в Амурскую область осуществляется еженедельно по средам и пятницам.</p>
        </div>
      </div>
    </div>
  </section>

  <script src="<?=SITE_TEMPLATE_PATH?>/include/delivery/delivery-calculator.js"></script>
</div>