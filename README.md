## Модуль оплаты Битрикс 20,19,18

### Установка

* Выберите модуль, соответствующий кодировке Вашего сайтаа (utf-8 или win-1251) в папке uploads
* Распакуйте содержимое архива в корень сайта по фтп
* Добавьте модуль в меню Магазин -> Настройки -> Платежные системы -> Добавить платежную систему
* Настройки:
 * Обработчик - Пользовательские - AssetPayments
 * Заголовок - Онлайн платежи AssetPayments
 * Название - Оплатить картой Visa/MasterCard (AssetPayments)
 * Активность - да
 * Сортировка - 100
 * Описание - Облачная платформа процессинга онлайн платежей AssetPayments
 * Логотип - указать путь к файлу asset_logo.png в папке upload
 * Открывать в новом окне - нет
 * Тип оплаты - Эквайринговая операция, или безналичный
 * Разрешить автопересчет оплаты - да
 * Разрешить печать чеков - нет
 * Кодировка - пусто
 * Код - пусто
 ----------------------------------------------------------------
 * ID Шаблона - 19
 * Секретный ключ - уточните в службе поддержки AssetPayments
 * ID магазина - уточните в службе поддержки AssetPayments
 * Сохранить

### Примечания
Протестировано с Bitrix версий 18, 19, 20 Управление сайтом (Дистрибутивы Малый бизнес и Бизнес) 
В случае ошибки проверьте права присвоенные файлам и папкам
- Владелец - Bitrix
- Папка 0775
- Файлы 0755 или 0644


## Bitrix 20, 19, 18 payment module

### Installation

* Choose correct encoding version of payment extension inside upload directory
* Upload archive contents to root directory of your website via ftp
* Add new module in Shop ->Settings->Payment methods->Add payment method
* Settings:
  * Processor - AssetPayments 
  * Title - Online payments AssetPayments
  * Name - Pay by card Visa/MasterCard (AssetPayments)
  * Active - yes
  * Sorting - 100
  * Description - Cloud-based online payments processing AssetPayments
  * Logo - set path to asset_logo.png inside upload folder
  * Open in new window - no
  * Payment type - acquiring
  * Allow recalculation - yes
  * Allow to print chaques - yes
  * Encoding - empty
  * Code - empty
  ----------------------------------------------------------------
 * Template ID - 19
 * Secret key - request at AssetPayments support departament
 * Shop ID - request at AssetPayments support departament
 * Press Save settings.
  
### Notes
Tested with Bitrix version 18, 19, 20 Site management (Small business & Business editions) 
If errors please check files and folders permission
- Owner - Bitrix
- Folders - 0775
- Files - 0755 или 0644
