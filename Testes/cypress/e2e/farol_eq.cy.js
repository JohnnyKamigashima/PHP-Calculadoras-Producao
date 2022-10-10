///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula largura do farol Equador', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page())

    it('Preencho os campos', () => {
        const $altura = '190';
        const $largura = '200';
        const $cilindro = 'true';

        MainPage.elements.farol_eq_altura()
            .type($altura);
        MainPage.elements.farol_eq_largura()
            .type($largura);
        MainPage.elements.farol_eq_cilindro()
            .check('true');
    })

    it('Obtenho resultado correto', () => {
        const $result = '55.14';
        const $area = '38000';

        MainPage.elements.farol_eq_area()
            .should('have.value', $area);
        MainPage.elements.farol_eq_result()
            .should('have.value', $result);
    })
})