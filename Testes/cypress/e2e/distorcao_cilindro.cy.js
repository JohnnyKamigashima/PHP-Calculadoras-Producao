///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula distorcao de cilindro', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page());

    it('Preencho os campos', () => {
        const $cilindro = '295';
        const $altura_da_arte = '100';

        MainPage.elements.distorcao_cilindro()
            .clear()
            .type($cilindro);
        MainPage.elements.distorcao_altura()
            .clear()
            .type($altura_da_arte);
        MainPage.elements.distorcao_repeticoes()
            .check('2');
    })

    it('Entao vejo o resultado correto', () => {
        const $result = "147.500";

        MainPage.elements.distorcao_resultado()
            .should('have.value', $result);
    })
})