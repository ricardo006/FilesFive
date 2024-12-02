// resources/js/registerValidation.js

export function validateName(name) {
    if (!name.trim()) {
        return 'O campo nome é obrigatório.';
    }
    return '';
}

export function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.trim()) {
        return 'O campo email é obrigatório.';
    } else if (!emailRegex.test(email)) {
        return 'Por favor, insira um email válido.';
    }
    return '';
}

export function validatePassword(password) {
    if (!password) {
        return 'O campo senha é obrigatório.';
    } else if (password.length < 6) {
        return 'A senha deve ter pelo menos 6 caracteres.';
    }
    return '';
}

export function validatePasswordConfirmation(password, passwordConfirmation) {
    if (password !== passwordConfirmation) {
        return 'As senhas não coincidem.';
    }
    return '';
}
