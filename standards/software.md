# Software standards

## [XAMPP 7.2](https://www.apachefriends.org/ru/index.html)
> Дистрибутив Apache, содержащий MariaDB, PHP и Perl

После установки, запустите модули Apache, MySQL  
Страница управления БД [phpMyAdmin](http://localhost/phpmyadmin/)  
Для разворачивания сайта, поместите его по следующему пути `path-to-xampp-root\htdocs\site`  
Адрес сайта `localhost/site`.

## [Git](https://git-scm.com/)
> Система контроля версий

После установки откройте командную строку и перейдите в папку и выполните клонирование текущего проекта
```
cd projects
git clone https://github.com/Vladicbl/DigitalWardenLog.git // клонирование удаленного репозитория
```
Для исключения конфликтов во время выполнения задания создавайте собственную ветку
```
git checkout -b name // создаст ветку и сразу сделает ее активной
```
По мере выполнения задания создавайте контрольные точки для обеспечения возможности отката
```
git add . // добавление всех файлов из текущей дериктории в локальный репозиторий
git commit -m "комментарий" // создание коммита с коментарием
```
По завершении задания необходимо отправить текущую ветку в удаленный репозиторий
```
git remote add origin https://github.com/Vladicbl/DigitalWardenLog.git
git push --set-upstream origin branch-name
```
Для обновления локальной версии проекта выполняйте команду `git pull`

## [GitHub](https://github.com/Vladicbl/DigitalWardenLog)
> Веб-сервис для хостинга IT-проектов и их совместной разработки

После отправки ветки в удаленный репозиторий необходимо инициировать запрос на "вливание" ваших изменений в главную ветку проекта  
Для этого на странице проекта нажмите на кнопку `New pull request`  
В качестве base-ветки выберите ветку `master`  
В пунктах `Reviewers` и `Assignes` укажите пользователя @x0k

## [Visual Studio Code](https://code.visualstudio.com/)
> Редактор кода для кроссплатформенной разработки веб- и облачных приложений. Включает в себя отладчик, инструменты для работы с Git, подсветку синтаксиса, IntelliSense и средства для рефакторинга.

Данный текстовый редактор выбран в качестве рекомендуемого по следующим причинам
* Встроенная поддержка Git
* Интегрированный терминал
* Расширения
  * [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
  * [VS Live Share](https://marketplace.visualstudio.com/items?itemName=MS-vsliveshare.vsliveshare)
* Tasks

Пример команды для развертывания сайта доступной по комбинации `ctrl + shift + b`
```JSON
{
  "label": "Build",
  "type": "shell",
  "command": "ROBOCOPY .\\src path-to-xampp-root\\htdocs\\journal /MIR",
  "group": {
    "kind": "build",
    "isDefault": true
  }
}
```