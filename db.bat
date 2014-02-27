if [%environment%] EQU [] set environment=prod

echo
echo environment=%environment%
echo

vendor\bin\ruckus.php.bat %*
