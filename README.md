# Система за класиране на  студенти
###Преглед

Тази система предоставя възможност за класиране на студенти по точки. Броят точки на всеки студент се определя от различни задачи, които студента трябва да изпълни през семестъра.Всяка различна задача има възнаграждава студента с различен брой точки. Класирането може да стане за последния час, седмица,  ден, месец или за цялото продължение на курса. Класирането се представя във формата на таблица и във формата на диаграма.

Системата предоставя и възможност за сравняване на успеваемостта на студентите от различни курсове. Резултатите се представят в диаграма и показват Максималните и Минималните точки, които са изкарани от студентите във всеки от курсовете които се сравняват, както и средната стойност на изкарани точки. Отново това сравнение може да бъде извършено за час, ден, седмица, месец или година.

Системата е базирана на CodeIgniter. Това е лек PHP фреймуърк, който позволява скоросто разработване на малки и средни приложения. За повече информация : [CodeIgniter Documentation](https://ellislab.com/codeigniter/user-guide/ ). 

Технологии:  HTML5, CSS3, JavaScript,PHP
Инструменти: [CodeIgniter](https://ellislab.com/codeigniter/), [Bootstrap](http://getbootstrap.com/), [jQuery](http://jquery.com/), [Chart.js](http://www.chartjs.org/)
###Инсталация

1. Файловете на системата се поставят  на сървъра (локален или друг).
2.  Файлът ./www_tech.sql  се импортва в MySQL (съдържа структурата на MySQL базата данни както и примерни данни)
3.  Отваря се файлът ./application/config/database.php и се настройват данните за достъп до базата данни

### Функционалност 

#### Административна част
Предоставя CRUD функционалност към отделните елементи на системата (Курсове, Студенти, Задачи, История)
> **Note:**
> Историята е досъпна като се отиде на страницата за листинг на студенти и на конкретен студент се избере "Действия" > "История"

Листинг (Read) частта на администрацията предоставя възможности за странициране, филтриране и подреждане по отделните колони на съответния модел.

#### Ранкинг и Сравнение

Тази част предоставя функционалността съответно за класиране на студенти и за сравнение на успеваемостта на отделните курсове.

###Имплементация

Начина на работа и потокът на данни в системата може най-просто да се представи по следния начин.

DB -> Опростен ORM (Model) -> CRUD api (Library) -> Master Controller -> Specific (Child) Controller -> Визуализация (View).

#### Опростен ORM

Реализацията на ORM-а се намира в /application/core/My_Model.php. Използвам термина ORM доста свободно тук. Това съм направил е разширяване на базовия модел на CodeIgniter (това е базовият клас, който всеки модел наследява), за да добавя типична ORM функционалност като свързване на колони от таблицата с членове на съответния клас, load и Collection функции, филтри и други. Причината за създаване на този ORM е за по-лесно построяване на следващото ниво - API.

#### CRUD API
Реализацията на API-то се намира в /application/library/api.php. Както името подсказва именно на това ниво се реализира CRUD функционалността на проекта. API-то предоставя възможност да му се зададе модел (ORM модел), който след това се използва за да се извърши съответното базово действие (create, read, readOne, update, delete)

#### Master Controller

Това е класът (My_Controller в /application/core/My_Controller.php), който наследява CI_Controller и се възползва от CRUD методите на API-то за да зареди listing, edit (create), и delete функционалност на всеки контролер, който го наследява.

#### Specific (Child) Controller

Контролерите, които искат да се възползват от CRUD функционалноста по-подразбиране, **трябва** да наследяват My_Controller, а не CI_Controller. Също така трябва да се спзава следната конвенция за наименоване на такива контролери:
	   1. Име на клас <Име-на-модел>_Controller
	  2.  Име на файл <име-на-модел>_controller.php
Където <име-на-модел> е името на ORM модела, който отговаря на таблицата, която този контролер трябва да управлява.

#### Визуализация

Визуализацията се извършва като се зареди "Обвиващия" изглед (wrapper view), който отговаря за зареждане на основната HTML структура, стилове и скриптове. След това се използва вградената на CodeIgniter функционалност да се запише изгледа в променлива за да се емулира наследяване.

По-конкретно - зарежда се конкретния изглед за даденото действие/контролер и се предава на $content променлива, която от своя страна се предава на обвиващия изглед.

#### Извличане на информация за ранкинг и сравнение

За да се постигне ранкинга и сравнението се разширяват класовете History и Course (ORM модели) с допълнителна функционалност. За определяне на времевия период се използва библиотеката time.php


#### Визуализация на ранкинг/сравнение

За визуализация на ранкинг страницата и страницата за сравнение се използва [Chart.js](http://www.chartjs.org/).
