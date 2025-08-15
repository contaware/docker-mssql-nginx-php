# MSSQL NGINX PHP stack built with Docker Compose

This stack is meant for local development and not for production usage. It consists of:

- MSSQL (runs in Linux container)
- Nginx
- PHP


## Installation

Clone this repository to your local computer:

```bash
git clone https://github.com/contaware/docker-mssql-nginx-php.git
```


## Usage and Configuration

### Start servers

1. Enter the project directory: `cd docker-mssql-nginx-php/`
2. Run: `docker compose up -d` 

### Stop servers

1. Enter the project directory: `cd docker-mssql-nginx-php/`
2. Run: `docker compose down`

### After configuration changes

Enter the project directory: `cd docker-mssql-nginx-php/`

- If *./nginx_conf/default.conf* has been changed, run:  
  `docker compose exec nginx nginx -s reload`

- If *./compose.yaml* has been changed, run:  
  `docker compose down`  
  `docker compose up -d`
   
- If *./Dockerfile* has been changed, run:  
  `docker compose down`  
  `docker compose up -d --build`

### Web Server and PHP

The Nginx server is listening on <http://localhost:8008>. Change the port in *./compose.yaml* file.

Place your web project files into *./html/* directory.

The installed PHP version along the extensions can be configured in *./Dockerfile* file.

### Database Server

MSSQL is configured to listen on port **1433**. Access the server with the **mssqldb** hostname, see *./html/index.php* for an example. The databases are stored under *./mssqldb_data/*.

The **sa** user has the **123456Ms** password. Server version, port and password can be changed in *./compose.yaml*. But note that in some cases it may be necessary to start with no databases, for that delete the *./mssqldb_data/* directory.

### sqlcmd

In your terminal start the [sqlcmd](https://learn.microsoft.com/en-us/sql/tools/sqlcmd/sqlcmd-use-utility) prompt like:

```
docker compose exec mssqldb /opt/mssql-tools18/bin/sqlcmd -S localhost,1433 -U sa -No
```

In the prompt you can issue any SQL command, always confirm with `go`. For example it's possible to execute a backup which gets written to *./mssqldb_data/backups* directory:

```
BACKUP DATABASE [mydb] TO DISK = 'backup-mydb.bak';
go
```
