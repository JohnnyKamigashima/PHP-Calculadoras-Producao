///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula triangulo de transgenico', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page())

    it('Preencho os campos', () => {
        const $altura = '190';
        const $largura = '200';

        MainPage.elements.triangulo_altura()
            .type($altura);
        MainPage.elements.triangulo_largura()
            .type($largura);
    })

    it('Obtenho resultado correto', () => {
        const $result = '18.74';

        MainPage.elements.triangulo_result()
            .should('have.value', $result);
    })
})