<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация успешно завершена");
?>

<div class="registration-success">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <!-- Карточка успеха -->
        <div class="success-card">
          <div class="success-header">
            <div class="success-icon-wrapper">
              <i class="fa fa-check-circle success-icon pulse"></i>
            </div>
            <h3 class="success-title">Регистрация успешно завершена</h3>
          </div>

          <div class="success-content">
            <div class="success-message">
              <p>Благодарим за регистрацию в нашем интернет-магазине метизов и крепежных изделий. Теперь вы можете пользоваться всеми возможностями личного кабинета.</p>
            </div>
            
            <div class="success-info-box">
              <h4 class="info-title"><i class="fa fa-info-circle"></i> Что дальше?</h4>
              <ul class="success-steps">
                <li>
                  <div class="step-number">1</div>
                  <div class="step-text">Информация о вашей учетной записи отправлена на указанный email</div>
                </li>
                <li>
                  <div class="step-number">2</div>
                  <div class="step-text">Вы можете перейти в <a href="/personal_section/">личный кабинет</a> прямо сейчас</div>
                </li>
                <li>
                  <div class="step-number">3</div>
                  <div class="step-text">Начните покупки в нашем <a href="/catalog/">каталоге продукции</a></div>
                </li>
              </ul>
            </div>

            <div class="benefits-box">
              <div class="benefits-header">
                <i class="fa fa-star benefits-icon"></i>
                <h4>Возможности личного кабинета</h4>
              </div>
              
              <div class="benefits-grid">
                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fa fa-history"></i>
                  </div>
                  <div class="benefit-text">История заказов</div>
                </div>
                
                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fa fa-truck"></i>
                  </div>
                  <div class="benefit-text">Отслеживание доставки</div>
                </div>
                
                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fa fa-percent"></i>
                  </div>
                  <div class="benefit-text">Персональные скидки</div>
                </div>
                
                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fa fa-file-invoice"></i>
                  </div>
                  <div class="benefit-text">Документы и счета</div>
                </div>
              </div>
            </div>
          </div>

          <div class="success-footer">
            <a href="/" class="btn btn-secondary"><i class="fa fa-home"></i> На главную</a>
            <a href="/personal_section/" class="btn btn-primary"><i class="fa fa-user"></i> В личный кабинет</a>
            <a href="/catalog/" class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i> Перейти к покупкам</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Основные стили для страницы успешной регистрации */
.registration-success {
  padding: 30px 0;
  background-color: #f8f8f8;
}

/* Карточка успеха */
.success-card {
  position: relative;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  overflow: hidden;
}

/* Шапка карточки */
.success-header {
  position: relative;
  text-align: center;
  padding: 25px 20px;
  background: linear-gradient(135deg, #f8f8f8, #fff);
  border-bottom: 1px solid rgba(238, 56, 49, 0.15);
}

.success-header:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: #ee3831;
}

.success-icon-wrapper {
  display: inline-block;
  margin-bottom: 15px;
  position: relative;
}

.success-icon {
  color: #ee3831;
  font-size: 42px;
  position: relative;
  z-index: 1;
}

.success-title {
  color: #333;
  font-size: 24px;
  margin-bottom: 0;
  font-weight: 600;
}

/* Контент карточки */
.success-content {
  padding: 30px;
  color: #555;
}

.success-message {
  text-align: center;
  margin-bottom: 25px;
  font-size: 16px;
  line-height: 1.6;
}

.success-message p {
  margin-bottom: 0;
}

/* Блок с инструкциями */
.success-info-box {
  background-color: #f8f8f8;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 25px;
  position: relative;
  border-left: 3px solid #ee3831;
}

.info-title {
  color: #333;
  font-size: 18px;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
}

.info-title i {
  color: #ee3831;
  margin-right: 10px;
}

.success-steps {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.success-steps li {
  display: flex;
  margin-bottom: 15px;
  align-items: flex-start;
}

.success-steps li:last-child {
  margin-bottom: 0;
}

.step-number {
  background-color: #ee3831;
  color: white;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  flex-shrink: 0;
  margin-right: 12px;
  margin-top: 2px;
}

.step-text {
  flex-grow: 1;
  line-height: 1.4;
}

.step-text a {
  color: #ee3831;
  text-decoration: none;
  border-bottom: 1px solid transparent;
  transition: border-color 0.3s ease;
}

.step-text a:hover {
  border-color: #ee3831;
}

/* Блок с преимуществами */
.benefits-box {
  background-color: #f8f8f8;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 10px;
}

.benefits-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.benefits-icon {
  color: #ee3831;
  font-size: 20px;
  margin-right: 10px;
}

.benefits-header h4 {
  color: #333;
  font-size: 18px;
  margin: 0;
}

.benefits-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
}

.benefit-item {
  display: flex;
  align-items: center;
  background-color: #fff;
  padding: 10px 15px;
  border-radius: 6px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.benefit-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.benefit-icon {
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(238, 56, 49, 0.1);
  color: #ee3831;
  border-radius: 50%;
  margin-right: 12px;
}

.benefit-text {
  font-size: 14px;
  font-weight: 500;
  color: #333;
}

/* Подвал карточки */
.success-footer {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 10px;
  padding: 20px 30px;
  background-color: #f8f8f8;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.success-footer .btn {
  flex: 1;
  min-width: 0;
  padding: 10px 15px;
  text-align: center;
  font-size: 14px;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.success-footer .btn i {
  margin-right: 8px;
}

.btn-primary {
  background-color: #ee3831;
  border-color: #ee3831;
}

.btn-primary:hover {
  background-color: #d32f29;
  border-color: #d32f29;
}

.btn-outline-primary {
  color: #ee3831;
  border-color: #ee3831;
}

.btn-outline-primary:hover {
  background-color: #ee3831;
  color: #fff;
}

/* Пульсирующая анимация */
@keyframes pulse {
  0% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.05);
    opacity: 0.8;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

.pulse {
  animation: pulse 2s infinite;
}

/* Адаптивность */
@media (max-width: 767px) {
  .success-content {
    padding: 20px;
  }
  
  .benefits-grid {
    grid-template-columns: 1fr;
  }
  
  .success-footer {
    flex-direction: column;
    padding: 15px 20px;
  }
  
  .success-footer .btn {
    margin-bottom: 10px;
  }
  
  .success-footer .btn:last-child {
    margin-bottom: 0;
  }
  
  .success-title {
    font-size: 20px;
  }
  
  .success-icon {
    font-size: 36px;
  }
}

/* Creative decorative elements */
.success-card::before,
.success-card::after {
  content: "";
  position: absolute;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  z-index: 0;
  opacity: 0.05;
}

.success-card::before {
  background: #ee3831;
  top: -100px;
  right: -100px;
}

.success-card::after {
  background: #ee3831;
  bottom: -100px;
  left: -100px;
}
</style>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>