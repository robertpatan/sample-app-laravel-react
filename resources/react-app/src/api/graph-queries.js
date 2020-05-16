const queries = {
  layout: {
    query: `
      query {
        menus(
          where: {isMain: true }
        ) {
          title
          link
          isMain
          nodes {
            title
            link
          }
        }
        socialIcon {
          icon {
            label
            className
            link
          }
        }
        footer {
          logoColumn {
            logo {
              alt
              image {
                url
              }
            }
            text
          }
          basicColumns {
            header
            Link {
              label
              iconClass
              link
            }
          }
        }
        socialIcon {
          icon {
            label
            className
            link
          }
        }
        newsletterForm {
          formAction
        }
      }
    `,
  },

  home: {
    query: `
      query {
        pages (
          limit: 1
          where:{title_contains: "Home"}
        ) {
          title
          dz {
            __typename
            ... on ComponentHomeHero {
              header
              smallHeader
              description
              mainImage {
                name
                url
              }
              backgroundImage {
                name
                url
              }
              Button {
                value
                link
                reactComponentName
              }
              
            }
            __typename
            ... on ComponentHomeWhy {
              smallHeader
              header
              description
              cards {
                icon {
                  name
                  url
                }
                cover {
                  name
                  url
                }
                header
                description
              }
            }
          }
        }
      }
    `,
  },
  about: {
    query: `
      query {
        pages(limit: 1, where: { title_contains: "About Us" }) {
          title
          content
          dz {
            __typename
            ... on ComponentAboutStepsSection {
              header {
                title
                smallTitle
                description
              }
              steps {
                stepName
                header
                number
                description
                direction
              }
            }
          }
        }
      }
    `,
  },

}


export default queries;
