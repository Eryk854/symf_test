Konfiguracja XDebug

Instalacja Xdebug dla XAMPP:

1. https://gist.github.com/odan/1abe76d373a9cbb15bed

Instalacja wtyczki w przeglądarce:

1. Instalujemy roszerzenie "Xdebug helper".
   (W firefox klikamy Ctrl+Shift+A. W miejscu "Znajdź więcej rozszerzeń" wpisujemy "Xdebug Helper for Firefox" i instalujemy).

2.   W konfiguracji Xdebug helper w polu "IDE key" wybieramy "PhpStorm".

Konfiguracja w PhpStorm:

1. Wchodzimy File->Settings->Languages & Frameworks->PHP->Debug
2. Klikamy 'Validate'
3. Zostawiamy opcje domyślne (jeśli pracujemy na lokalnym serwerze). 
4. Naciskamy na przycisk 'Validate'.

Jeśli walidacja daje nam pozytyne wyniki , to poprawnie skonfigurowaliśmy XDebug.
(Debug protocol nie musi być oznaczony na zielono)

Do debugowania:
1. Ustawiamy breakpointy.
2. Klikamy w PhpStorm przycisk 'Start Listening for PHP Debug Connections' (przycisk słuchawki w pobliżu przycisku do uruchamiania aplikacji).
3. Uruchamiamy sesję debugowania poprzez wpisanie adresu w przeglądarce. (Powinien wywołać się PhpStorm na linijce na której jest breakpoint).

Za pomocą F8 przechodzimy do kolejnych linijek.

Dzięki XDebug możemy korzystać z funkcji dump($wartość) (do podglądania wartości).
