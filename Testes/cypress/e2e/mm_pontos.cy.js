///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula mm para pontos', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page());
    it('Preencho o campo de pontos', () => {
        const $mm = '100';

        MainPage.elements.pontos_mm()
            .type($mm);
    })

    it('Entao vejo o resultado correto', () => {
        const $result = "283.50";

        MainPage.elements.pontos_pt()
            .should('have.value', $result);
    })
})