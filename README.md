<h1>Instruction</h1>

<p>В процессе разработки ПО часто возникает потребность в тестовых данных. Ведь разработчику необходимо удостоверится что программа будет корректно работать с реальным объемом данных до того как она передасться заказчику.  В случае, когда объем данных не играет никакой роли это не вызовет серьезных проблем, но как быть если предпологается что таблица БД может содержать 1000000 и более записей? Как 
быстро и просто создать тестовые данные для этой таблицы? Для этого необходим гибкий и простой инструмент способный быстро сгенерировать тестовый данные в любом удобном для импорта формате.
</p>

<p>
Архитектура приложения

Для обеспечения максимальной гибкости приложение разбивается на 4 составные
части

Источник:
 - Предоставляет данные конфигурации для редера

Редер:
 - Читает данные конфигурации из произвольного формата. Т.о. возможно создать
   редер для любого формата 

Врайтер:
- Преобразует сгенерированный данные в произвольный формат и передает их в цель. Возможно
  реализовать врайтер для любого формата

Цель:
- Записывает сгенеригованные данные в произовольное место. Обычно это файл, но
  может быть что-то другое. в любом случае, всегда можно сгенерировать свою
  цель

</p>
