///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula pontos para mm', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page());

    it('Preencho o campo de pontos', () => {
        const $pontos = '295';

        MainPage.elements.pontos_pt()
            .type($pontos);
    })

    it('Entao vejo o resultado correto', () => {
        const $result = "104.06";

        MainPage.elements.pontos_mm()
            .should('have.value', $result);
    })
})
