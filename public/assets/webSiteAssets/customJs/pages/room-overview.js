$(document).ready(()=>{
    $.sessionTimeout({
        keepAliveUrl: 'session-out',
        logoutButton: 'Logout',
        logoutUrl: 'login',
        redirUrl: '/',
        warnAfter: 10000,
        redirAfter: 30000,
        countdownMessage: 'Redirecting in {timer} seconds.'
      });
});