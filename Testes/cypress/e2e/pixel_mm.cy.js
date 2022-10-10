///<reference types="cypress"/>
import MainPage, { main_page } from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula pixel para mm', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page());
    it('Preencho o campo de pontos', () => {
        const $mm = '100';
        const $resolucao = '300';

        MainPage.elements.pixel_mm()
            .clear()
            .type($mm)
        MainPage.elements.pixel_resolucao()
            .clear()
            .type($resolucao)
    })

    it('Entao vejo o resultado correto', () => {
        const $result = "1182";

        MainPage.elements.pixel_result()
            .should('have.value', $result);
    })
})