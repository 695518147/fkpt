FROM linode/lamp
WORKDIR /project
COPY . /project
EXPOSE 9090:9090
CMD ["tail","-f", "./fkpt.php"]