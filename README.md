![image](https://user-images.githubusercontent.com/51045274/170120086-b0b66ecd-48fb-4ff4-a43a-c163d9a57567.png)

Credits
For the list of people who've put work into PHP, please see the [PHP credits page](https://php.net/credits.php).

# AccessLogStatistic

Задание:
Имеется обычный http access_log файл.
Требуется написать PHP скрипт, обрабатывающий этот лог и выдающий информацию о нём в json виде.

Требуемые данные:
  - количество хитов/просмотров,
  - количество уникальных url,
  - объем трафика,
  - количество строк всего,
  - количество запросов от поисковиков,
  - коды ответов.

### Требования

  - Код может быть любым, начиная от простого plain text скрипта, до продуманной архитектуры standalone приложения.
  - Главное требование — он должен быть production ready. То есть легко читаться сторонним разработчиком, легко поддерживаться при каких-либо изменениях к требованиям в будущем и аккуратно оформлен. Представьте, что вы делаете Pull Request для реальной задачи.  
  - Также код должен справляться с большим объемом записей. Представьте, что ему будет скормлен лог файл на 1 млрд. строк.

### Пример ожидаемого вывода:
```sh
#!/bin/bash

php parser.php ./acess_log

# Output

{ views: 16,
  urls: 5,
  traffic: 187990,
  crawlers: {
      Google: 2,
      Bing: 0,
      Baidu: 0,
      Yandex: 0 },
  statusCodes: {
      200 : 14,
      301 : 2 }
}

![image](https://user-images.githubusercontent.com/51045274/170120975-6efd0cd6-81b6-428b-8efe-0ee171f7927b.png)
