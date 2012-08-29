<h1>Data generator</h1>

<h2>What is this?</h2>
<p>In the software development process is often a need to test data. Anyway, the programmer needs to make sure that the program will work with the actual amount of data before it will give to the customer. In the case when the amount of data does not matter it will not cause serious problems, but what if that is supposed database table can contain more than 1000000 and more records?  How to quickly and easily create test data for this table? This requires a flexible and simple tool capable of quickly generate test data in a useful format for import to the database.</p>

<h2>Архитектура приложения</h2>
<p>Для обеспечения максимальной гибкости приложение разбивается на 4 составные части</p>

<h2>Источник</h2>
<p>Предоставляет данные конфигурации для редера</p>

<h2>Редер</h2>
<p>Читает данные конфигурации из произвольного формата. Т.о. возможно создать редер для любого формата</p>

<h2>Врайтер</h2>
<p>Преобразует сгенерированный данные в произвольный формат и передает их в цель. Возможно реализовать врайтер для любого формата</p>

<h2>Цель</h2>
<p>Записывает сгенеригованные данные в произовольное место. Обычно это файл, но
может быть что-то другое. в любом случае, всегда можно сгенерировать свою цель</p>
