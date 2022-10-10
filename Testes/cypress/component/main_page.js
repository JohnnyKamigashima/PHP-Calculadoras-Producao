/// <reference types="cypress"/>

class MainPage {
    elements = {
        escala_plano_medida_real: () => cy.get("#medR"),
        escala_plano_medida_atual: () => cy.get("#medA"),
        escala_plano_resultado: () => cy.get("#escalaC"),
        distorcao_cilindro: () => cy.get('#cilindro'),
        distorcao_altura: () => cy.get('#arteA'),
        distorcao_repeticoes: () => cy.get('[type="radio"]'),
        distorcao_resultado: () => cy.get('#distorc'),
        peso_neto_pais: () => cy.get('#pais'),
        peso_neto_altura: () => cy.get('#altFOP3'),
        peso_neto_largura: () => cy.get('#largFOP3'),
        peso_neto_peso: () => cy.get('#peso'),
        peso_neto_result: () => cy.get('#resultmm1'),
        pontos_pt: () => cy.get('#pt'),
        pontos_mm: () => cy.get('#resultmm'),
        pixel_resolucao: () => cy.get('#resolucao'),
        pixel_mm: () => cy.get('#mm'),
        pixel_result: () => cy.get('#pixel'),
        triangulo_altura: () => cy.get('#altFOP2'),
        triangulo_largura: () => cy.get('#largFOP2'),
        triangulo_result: () => cy.get('#largT1'),
        farol_eq_altura: () => cy.get('#altura_farol_eq'),
        farol_eq_largura: () => cy.get('#largura_farol_eq'),
        farol_eq_cilindro: () => cy.get('[name="cilindro"]'),
        farol_eq_area: () => cy.get('#area_farol_eq'),
        farol_eq_result: () => cy.get('#largura_final'),
        farol_octagono_pais: () => cy.get('#pais5'),
        farol_octagono_altura: () => cy.get('#altFOP5'),
        farol_octagono_largura: () => cy.get('#largFOP5'),
        farol_octagono_result: () => cy.get('#largF5'),
        alto_em_altura: () => cy.get('#altFOP'),
        alto_em_largura: () => cy.get('#largFOP'),
        alto_em_area: () => cy.get('#areaFOP'),
        alto_em_nutrientes: () => cy.get('#nutrientes'),
        alto_em_organizacao: () => cy.get('#tipo'),
        alto_em_minima: () => cy.get('#largF'),
        alto_em_maxima: () => cy.get('#largMx')

    }

    main_page() {
        cy.visit('https://jhk.app')
    }
}

module.exports = new MainPage();