@echo off
title SPORT.CPE Local Web Server
echo ====================================================
echo  Starting SPORT.CPE Web Server on port 8000...
echo  Opening browser at http://localhost:8000
echo ====================================================
start "" "http://localhost:8000"
node server.js
pause

