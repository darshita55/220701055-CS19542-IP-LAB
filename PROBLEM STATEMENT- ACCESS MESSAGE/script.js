function checkAccess(role, file) {
    const permissions = {
        teacher: ['attendance', 'home-work'],
        student: ['class-work', 'home-work']
    };
    const accessMessage = document.getElementById('access-message');
    if (permissions[role] && permissions[role].includes(file)) {
        
        accessMessage.textContent = 'ACCESS GRANTED';
        accessMessage.classList.add('granted');
        accessMessage.classList.remove('denied');
    } else if (permissions[role] && !permissions[role].includes(file)) {
        
        accessMessage.textContent = 'ACCESS DENIED';
        accessMessage.classList.add('denied');
        accessMessage.classList.remove('granted');
    } else {
        
        console.error('ERROR: INVALID ROLE OR FILE');
    }
}
checkAccess('teacher', 'attendance'); 

