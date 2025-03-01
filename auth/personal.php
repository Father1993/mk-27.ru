<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

global $USER;
if(!$USER->IsAuthorized()) {
    LocalRedirect('/auth/');
}

// Получаем активную вкладку из параметров URL
$activeTab = isset($_GET['tab']) ? htmlspecialchars($_GET['tab']) : 'profile';
?>

<div class="personal-wrapper">
  <div class="container">
    <div class="row g-4">
      <!-- Боковое меню -->
      <div class="col-md-3">
        <div class="card profile-sidebar mb-4">
          <div class="card-body p-4">
            <div class="profile-user text-center mb-4">
              <h5 class="mt-4"><?=$USER->GetFullName()?></h5>
              <p class="text-muted mb-0"><?=$USER->GetEmail()?></p>
            </div>

            <ul class="nav flex-column profile-nav">
              <li class="nav-item mb-2">
                <a class="nav-link <?=$activeTab == 'profile' ? 'active' : ''?> d-flex align-items-center"
                  href="#profile" data-bs-toggle="tab" data-tab="profile">
                  <i class="bi bi-person me-3"></i>
                  <span>Профиль</span>
                </a>
              </li>
              <li class="nav-item mb-2">
                <a class="nav-link <?=$activeTab == 'orders' ? 'active' : ''?> d-flex align-items-center" href="#orders"
                  data-bs-toggle="tab" data-tab="orders">
                  <i class="bi bi-cart me-3"></i>
                  <span>История заказов</span>
                </a>
              </li>
              <li class="nav-item">
                <form action="<?=$APPLICATION->GetCurPage()?>" method="POST">
                  <input type="hidden" name="logout" value="yes">
                  <button type="submit"
                    class="nav-link text-danger border-0 bg-transparent w-100 text-start d-flex align-items-center">
                    <i class="bi bi-box-arrow-right me-3"></i>
                    <span>Выйти</span>
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Основной контент -->
      <div class="col-md-9">
        <div class="tab-content">
          <!-- Вкладка профиля -->
          <div class="tab-pane fade <?=$activeTab == 'profile' ? 'show active' : ''?>" id="profile">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.profile",
                "my",
                array(
                    "CHECK_RIGHTS" => "N",
                    "SEND_INFO" => "N",
                    "SET_TITLE" => "N",
                    "USER_PROPERTY" => array(
                        "UF_ISURFACE",
                        "UF_ORGNAME",
                        "UF_ORGINN",
                        "UF_FIO",
                        "UF_POST_ADDRESS",
                        "UF_REALADDRESS",
                        "UF_URADDRESS",
                        "UF_HEAD_PHONE",
                        "UF_KPPORG",
                        "UF_CONTACT_PERSON",
                        "UF_DELIVERY_ADDR"
                    ),
                    "USER_PROPERTY_NAME" => ""
                ),
                false
            );?>
          </div>

          <!-- Вкладка истории заказов -->
          <div class="tab-pane fade <?=$activeTab == 'orders' ? 'show active' : ''?>" id="orders">
            <?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.list", "my-order-list", array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "DEFAULT_SORT" => "DATE_INSERT",
                "HISTORIC_STATUSES" => array("F"),
                "NAV_TEMPLATE" => "",
                "ORDERS_PER_PAGE" => "10",
                "PATH_TO_CANCEL" => "",
                "PATH_TO_COPY" => "",
                "PATH_TO_DETAIL" => "",
                "PATH_TO_PAYMENT" => "payment.php",
                "REFRESH_PRICES" => "N",
                "SAVE_IN_SESSION" => "Y",
                "SET_TITLE" => "N",
                "STATUS_COLOR_F" => "gray",
                "STATUS_COLOR_N" => "green",
                "STATUS_COLOR_P" => "yellow",
                "STATUS_COLOR_PSEUDO_CANCELLED" => "red",
                "PATH_TO_BASKET" => "",
                "PATH_TO_CATALOG" => "/catalog/",
                "DISALLOW_CANCEL" => "N",
                "ALLOW_INNER" => "N",
                "ONLY_INNER_FULL" => "N"
            ),
            false
            );?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
:root {
  --primary-color: #ee3831;
  --primary-hover: #d62d26;
  --text-color: #2c3e50;
  --muted-color: #7f8c8d;
  --border-color: #e9ecef;
  --bg-light: #f8f9fa;
  --shadow-color: rgba(0, 0, 0, 0.05);
}

.personal-wrapper {
  padding: 3rem 0;
  background: var(--bg-light);
  min-height: calc(100vh - 200px);
}

.profile-sidebar {
  border: none;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1.5rem var(--shadow-color);
  background: white;
}

.profile-avatar {
  margin-bottom: 1.5rem;
}

.avatar-circle {
  width: 80px;
  height: 80px;
  margin: 0 auto;
  background: var(--primary-color);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(238, 56, 49, 0.2);
}

.avatar-circle .initials {
  color: white;
  font-size: 28px;
  font-weight: 600;
  text-transform: uppercase;
}

.profile-user h5 {
  color: var(--text-color);
  font-weight: 600;
  font-size: 1.25rem;
}

.profile-user .text-muted {
  color: var(--muted-color) !important;
  font-size: 0.875rem;
}

.profile-nav {
  margin: 0 -1rem;
}

.profile-nav .nav-link {
  padding: 0.875rem 1.5rem;
  color: var(--text-color);
  border-radius: 0.75rem;
  transition: all 0.3s ease;
  margin: 0 1rem;
  font-weight: 500;
}

.profile-nav .nav-link:hover {
  background: rgba(238, 56, 49, 0.1);
  color: var(--primary-color);
}

.profile-nav .nav-link.active {
  background: var(--primary-color);
  color: white;
  box-shadow: 0 4px 12px rgba(238, 56, 49, 0.2);
}

.profile-nav .nav-link i {
  font-size: 1.25rem;
  width: 24px;
  text-align: center;
}

.tab-content {
  background: white;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1.5rem var(--shadow-color);
}

.tab-pane {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .personal-wrapper {
    padding: 1.5rem 0;
  }

  .profile-sidebar {
    margin-bottom: 1.5rem;
  }

  .profile-nav .nav-link {
    padding: 0.75rem 1rem;
    margin: 0 0.5rem;
  }

  .tab-content {
    padding: 1.5rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Функция для обновления URL с параметром активной вкладки
  function updateURL(tab) {
    const url = new URL(window.location);
    url.searchParams.set('tab', tab);
    window.history.replaceState({}, '', url);
  }

  // Инициализация табов Bootstrap с сохранением активной вкладки
  var triggerTabList = [].slice.call(document.querySelectorAll('.profile-nav .nav-link'));
  triggerTabList.forEach(function(triggerEl) {
    triggerEl.addEventListener('click', function(event) {
      event.preventDefault();
      const tab = this.getAttribute('data-tab');

      // Обновляем URL
      updateURL(tab);

      // Активируем таб
      var tabTrigger = new bootstrap.Tab(triggerEl);
      tabTrigger.show();
    });
  });

  // Обработка прямых ссылок внутри табов
  document.querySelectorAll('.tab-pane a').forEach(function(link) {
    link.addEventListener('click', function(e) {
      // Получаем активную вкладку
      const activeTab = document.querySelector('.nav-link.active').getAttribute('data-tab');

      // Если ссылка не содержит параметр tab, добавляем его
      if (this.href.indexOf('tab=') === -1) {
        e.preventDefault();
        const url = new URL(this.href);
        url.searchParams.set('tab', activeTab);
        window.location.href = url.toString();
      }
    });
  });
});
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>