///<reference types="cypress"/>
import MainPage from "../component/main_page";

Cypress.on('uncaught:exception', (err, runnable) => {
    // returning false here prevents Cypress from
    // failing the test
    return false
})

describe('Calcula largura do Alto Em', () => {
    it('Dado que eu visite a página de calculadoras', () => MainPage.main_page())

    it('Preencho os campos', () => {
        const $altura = '190';
        const $largura = '200';
        const $organizacao = "I";
        const $nutrientes = '2';

        MainPage.elements.alto_em_altura()
            .type($altura);
        MainPage.elements.alto_em_largura()
            .type($largura);
        MainPage.elements.alto_em_organizacao()
            .select($organizacao);
        MainPage.elements.alto_em_nutrientes()
            .select($nutrientes);
    })

    it('Obtenho resultado correto', () => {
        const $area = '38000';
        const $result_min = '31.02';
        const $result_max = '34.05';

        MainPage.elements.alto_em_area()
            .should('have.value', $area);
        MainPage.elements.alto_em_minima()
            .should('have.value', $result_min);
        MainPage.elements.alto_em_maxima()
            .should('have.value', $result_max);
    })
})